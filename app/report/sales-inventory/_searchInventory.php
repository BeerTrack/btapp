<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Search Inventory</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=add">

            <div class="form-group col-xs-4 col-no-padding-left">
                <label>Beer Name</label>
                <select id="" name="inventory_beer_name" class="form-control">
                    <option>Select a Beer</option>
                    <?php
                    //getting names of the beers associated with this brewery
                    $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands WHERE brewery_id = '$loggedInBreweryID' ORDER BY beer_name");

                    while($row = mysqli_fetch_array($displayTransactionQuery)) 
                    {
                        echo "<option value=\"" . $row['beer_id']  . "\">" . $row['beer_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-xs-4">
                <label>Location</label>
                <select id="" name="inventory_location" class="form-control">
                    <option>Select a Store</option>
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

            <div class="form-group col-xs-4 col-no-padding-right">
                <label>Inventory Timespan</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="timespanForInventoryLookup" name="timespanForInventoryLookup">
                </div>
            </div>

            <!-- (Below) CODE FOR GETTING THE TYPE, SIZE (ML), AND QUANITY PER PACKAGE. WE GET ALL 3 DATA POINTS TOGETHER, AND THEN OUTPUT INTO SELECT'S BELOW... -->
            <?php
            //getting all the package sizes of any beers associated with this brewery
            $todaysDate = date('Y-m-d');
            $todaysDate = '2015-03-14'; //temporary
            $selectUnitVolume = '';
            $selectQuanityPerPackage = '';

            $selectUnitVolumeQuery = "SELECT DISTINCT single_package_volume FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID' AND run_timestamp >= '$todaysDate'";
            $selectQuanityPerPackageQuery = "SELECT DISTINCT single_package_quantity FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID' AND run_timestamp >= '$todaysDate'";

            $displayUnitVolumeResults = beerTrackDBQuery($selectUnitVolumeQuery);
            $displayQuanityPerPackageResults = beerTrackDBQuery($selectQuanityPerPackageQuery);

            while($row = mysqli_fetch_array($displayUnitVolumeResults)) 
            {
                $selectUnitVolume .= "<option value=\"" . $row['single_package_volume']  . "\">" . $row['single_package_volume'] . " ml</option>";
            }

            while($row = mysqli_fetch_array($displayQuanityPerPackageResults)) 
            {
                $selectQuanityPerPackage .= "<option value=\"" . $row['single_package_quantity']  . "\">" . $row['single_package_quantity'] . "</option>";
            }

            ?>

            <div class="form-group col-xs-4 col-no-padding-left">
                <label>Package Type</label>
                <select id="" name="inventory_package_size" class="form-control">
                    <option>Choose a Package Type</option>
                    <option value="Bottle">Bottle</option>
                    <option value="Can">Can</option>
                </select>
            </div>

            <div class="form-group col-xs-4">
                <label>Unit Volume</label>
                <select id="" name="inventory_package_size" class="form-control">
                    <option>Choose a Unit Volume</option>
                    <?php echo $selectUnitVolume; ?>
                </select>
            </div>

            <div class="form-group col-xs-4 col-no-padding-right">
                <label>Quanity per Package</label>
                <select id="" name="inventory_package_size" class="form-control">
                    <option>Choose a Quanity</option>
                    <?php echo $selectQuanityPerPackage; ?>
                </select>
            </div>

            <div class="box-footer" style="padding-left:0px; padding-right: 0px">
                <button type="submit" class="btn btn-primary btn-block">Retrieve Inventory</button>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->

<script type="text/javascript">
     //Date range picker
        $('#timespanForInventoryLookup').daterangepicker();
    </script>


