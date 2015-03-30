<!-- Adds a point of sale entry, through the use of a form -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">New Sale</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=newOrder">
            <div class="form-group col-xs-3">
                <label>Location</label>
                <select id="" name="inventory_location" class="form-control">
                    <option value="all">Select Location</option>
                    <option value="<?php echo $loggedInBreweryID; ?>">Brewery Headquarters (<?php echo $loggedInBreweryAddress; ?>)</option>
                    
                    <!-- fill the options section for the dropdown -->
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

            <div class="form-group col-xs-3 col-no-padding-left">
                <label>Beer Name</label>
                <select id="beer_name" name="beer_name" class="form-control">
                    <option>Select a Beer</option>
                    <!-- fill the options section for the dropdown -->
                    <?php
                    //getting names of the beers associated with this brewery
                    $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands WHERE brewery_id = '$loggedInBreweryID'");

                    while($row = mysqli_fetch_array($displayTransactionQuery)) 
                    {
                        echo "<option value=\"" . $row['beerstore_beer_id']  . "\">" . $row['beer_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="form-group col-xs-2 col-no-padding-left">
                <label>Package</label>
                <select id="" name="inventory_package_option" class="form-control">
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
                echo "<option value=\"" . $row['can_bottle_desc']  . "\">" . $row['can_bottle_desc'] . "</option>";
            }

            ?>
                </select>
            </div>

            <div class="form-group col-xs-2 col-no-padding-left">
                <label>Price Per Unit</label>
                <input type="text" id="unit_price" onChange="calcTotal()" onblur="calcTotal()" name="unit_price" class="form-control" placeholder="Price">
            </div>

            <div class="form-group col-xs-2 col-no-padding-left">
                <label>Quantity Purchased</label>
                <input type="text" id="quantity_purchased" onChange="calcTotal()" onblur="calcTotal()" name="quantity_purchased" class="form-control" placeholder="Quantity">
            </div>

            <div class="form-group col-xs-push-10 col-xs-2 col-no-padding-left">
                <label>Order Total</label>
                <p><span id="order_total">$0.00</span><button style="float:right" type="button" onclick="calcTotal()" class="btn btn-primary btn-xs">Recalcuate</button></p>

            </div>
       
            <div class="box-footer" style="padding-left:0px; padding-right: 0px">
                <button type="submit" class="btn btn-primary btn-block">Process Order</button>
                <a href="?requestedAction=newSearch" class="btn btn-primary btn-block">Clear Order</a>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->


<script type="text/javascript">
//Calculates the total price of the order placed 
function calcTotal()
{
    var unit_price = parseInt($("#unit_price").val());
    var quantity_purchased = parseInt($("#quantity_purchased").val());

    var total = unit_price * quantity_purchased;

    $("#order_total").html(total);
    $("#order_total").text('$' + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
}

</script>