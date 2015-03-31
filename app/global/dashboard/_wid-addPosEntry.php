<!-- If statements to determine the size of this widget (which depends on the instance) -->
<?php if($showingCourse == 'MSCI444'){ ?>
<section class="col-lg-6 connectedSortable">
<?php } ?>
<?php if($showingCourse == 'MSCI436'){ ?>
<section class="col-lg-3 connectedSortable">
<?php } ?>


  <div class="box box-primary homepage-dashboard-box">
      <div class="box-header">
        <h3 class="box-title">New Walk in Order</h3>
      </div>
      <div class="box-body">
		<form role="form" method="post" action="/app/report/pos-entry/?requestedAction=newOrder">
            <div class="form-group col-xs-12 col-no-padding-left">
                <label>Location</label>
                <select id="" name="inventory_location" class="form-control">
                    <option value="all">Select Location</option>
                    <option value="<?php echo $loggedInBreweryID; ?>">Brewery Headquarters (<?php echo $loggedInBreweryAddress; ?>)</option>
                    <?php
                    //getting names of the stores associated with this brewery
                    $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM stores WHERE brewery_id = '$loggedInBreweryID' ORDER BY location_name");

                    while($row = mysqli_fetch_array($displayTransactionQuery)) 
                    {
                        echo "<option value=\"" . $row['beerstore_store_id']  . "\">" . $row['location_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-xs-12 col-no-padding-left">
                <label>Beer Name</label>
                <select id="beer_name" name="beer_name" class="form-control">
                    <option>Select a Beer</option>
                    <?php
                    //getting names of the beers associated with this brewery
                    $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands WHERE brewery_id = '$loggedInBreweryID'");

                    while($row = mysqli_fetch_array($displayTransactionQuery)) 
                    {
                        echo "<option value=\"" . $row['beer_name']  . "\">" . $row['beer_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

             <?php
            //getting all the package sizes of any beers associated with this brewery
            $todaysDate = date('Y-m-d');
            $todaysDate = '2015-03-14'; //temporary
            $selectUnitVolume = '';
            $selectQuanityPerPackage = '';

            $selectPackageOptions = "SELECT DISTINCT can_bottle_desc FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID' AND run_timestamp >= '$todaysDate'";

            $packageOptionsFromDB = beerTrackDBQuery($selectPackageOptions);

            while($row = mysqli_fetch_array($packageOptionsFromDB)) 
            {
                $packageOptions .= "<option value=\"" . $row['can_bottle_desc']  . "\">" . $row['can_bottle_desc'] . "</option>";
            }

            ?>

            <div class="form-group col-xs-12 col-no-padding-left">
                <label>Package</label>
                <select id="" name="inventory_package_option" class="form-control">
                    <?php echo $packageOptions; ?>
                </select>
            </div>

            <div class="form-group col-xs-12 col-no-padding-left">
                <label>Price Per Unit</label>
                <input type="text" id="unit_price" onChange="calcTotal()" onblur="calcTotal()" name="unit_price" class="form-control" placeholder="Price">
            </div>

            <div class="form-group col-xs-12 col-no-padding-left">
                <label>Quantity Purchased</label>
                <input type="text" id="quantity_purchased" onChange="calcTotal()" onblur="calcTotal()" name="quantity_purchased" class="form-control" placeholder="Quantity">
            </div>

            <div class="form-group col-xs-12 col-no-padding-left">
                <label>Order Total</label>
                <p><span id="order_total">$0.00</span><button style="float:right" type="button" onclick="calcTotal()" class="btn btn-primary btn-xs">Recalcuate</button></p>

            </div>
       
            <div class="box-footer" style="padding-left:0px; padding-right: 0px">
                <button type="submit" class="btn btn-primary btn-block">Process Order</button>
                <a href="?requestedAction=newSearch" class="btn btn-primary btn-block">Clear Order</a>
            </div>

        </form>
      </div>
    </div>
</section>



<script type="text/javascript">
//calculating the total (quanity multiplied by sale price)
function calcTotal()
{
    var unit_price = parseInt($("#unit_price").val());
    var quantity_purchased = parseInt($("#quantity_purchased").val());

    var total = unit_price * quantity_purchased;

    $("#order_total").html(total);
    $("#order_total").text('$' + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
}

</script>
