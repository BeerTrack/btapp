<!-- general form elements disabled -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">New Sale</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=newOrder">
            <!-- text input -->
            <div class="form-group col-xs-4 col-no-padding-left">
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

            <div class="form-group col-xs-4 col-no-padding-left">
                <label>Package Type</label>
                <select id="package_type" name="package_type" class="form-control">
                    <option>Choose a Package Type</option>
                    <option value="Bottle">Bottle</option>
                    <option value="Can">Can</option>
                </select>
            </div>
            
            <div class="form-group col-xs-4 col-no-padding-left">
                <label>Quantity per Package</label>
                <select id="package_quantity" name="package_quantity" class="form-control">
                    <option>Choose a Quantity</option>
                    <option value="1">1</option>
                    <option value="6">6</option>
                    <option value="12">12</option>
                    <option value="24">24</option>
                </select>
            </div>
       
            <div class="box-footer" style="padding-left:0px; padding-right: 0px">
                <button type="submit" class="btn btn-primary btn-block">Add To Cart</button>
                <a href="?requestedAction=newSearch" class="btn btn-primary btn-block">Clear Order</a>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->


<script type="text/javascript">
   //auto selecting values, if the page has been posted previously...
    var requestedAction = getQueryVariable("requestedAction");
    // http://stackoverflow.com/a/827378
    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        } 
        return '';
    }

    if(requestedAction ==="newOrder")
    {

        var beer_name = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['beer_name']); ?>';
        var package_type = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['package_type']); ?>';
        var package_quantity = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['package_quantity']); ?>';

        $('select[name^="beer_name"] option[value="' + beer_name  + '"]').attr("selected","selected");
        $('select[name^="package_type"] option[value="' + package_type + '"]').attr("selected","selected");
        $('select[name^="package_quantity"] option[value="' + package_quantity + '"]').attr("selected","selected");

    }

</script>


<!-- - Form with fields for adding a beer (See elements here: http://almsaeedstudio.com/AdminLTE/pages/forms/general.html)</br>
- POST this data back to the index page </br>
- finish "addBeer" function (in index.php), it should submit the data back to the database.  -->