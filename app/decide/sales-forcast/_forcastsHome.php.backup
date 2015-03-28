<?php
//Get start, current, and end dates

?>



<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Forecast Beer Sales</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" method="post" action="?requestedAction=forecast&viewName=results">

            <div class="form-group col-xs-6 col-no-padding-left">
                <label>Beer Name</label>
                <select id="" name="inventory_beerstore_id" class="form-control">
                    <option value="all">All Beers</option>
                    <?php
                    //getting names of the beers associated with this brewery
                    $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands WHERE brewery_id = '$loggedInBreweryID' AND beerstore_beer_id IN (SELECT DISTINCT beerstore_beer_id FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID')");

                    while($row = mysqli_fetch_array($displayTransactionQuery)) 
                    {
                        echo "<option value=\"" . $row['beerstore_beer_id']  . "\">" . $row['beer_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-xs-6 col-no-padding-right">
                <label>Location</label>
                <select id="" name="inventory_location" class="form-control">
                    <option value="all">All Stores</option>
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

            <div class="form-group col-xs-6">
                <label>What past data should be used for forecast?</label>
                <div class="form-group">
                    <input type="date" class="form-control" id= "timespan_forecast_data_source" name="timespan_forecast_data_source">
                </div>
            </div>

             <div class="form-group col-xs-6">
                <label>What period do you want to forecast for?</label>
                <div class="form-group">
                    <input type="date" class="form-control" id= "timespan_forecast_for" name="timespan_forecast_for">
                </div>
            </div>



            <!-- (Below) CODE FOR GETTING THE TYPE, SIZE (ML), AND QUANITY PER PACKAGE. WE GET ALL 3 DATA POINTS TOGETHER, AND THEN OUTPUT INTO SELECT'S BELOW... -->
            <?php
            // //getting all the package sizes of any beers associated with this brewery
            // $todaysDate = date('Y-m-d');
            // $todaysDate = '2015-03-14'; //temporary
            // $selectUnitVolume = '';
            // $selectQuanityPerPackage = '';

            // $selectUnitVolumeQuery = "SELECT DISTINCT single_package_volume FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID' AND run_timestamp >= '$todaysDate'";
            // $selectQuanityPerPackageQuery = "SELECT DISTINCT single_package_quantity FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID' AND run_timestamp >= '$todaysDate'";

            // $displayUnitVolumeResults = beerTrackDBQuery($selectUnitVolumeQuery);
            // $displayQuanityPerPackageResults = beerTrackDBQuery($selectQuanityPerPackageQuery);

            // while($row = mysqli_fetch_array($displayUnitVolumeResults)) 
            // {
            //     $selectUnitVolume .= "<option value=\"" . $row['single_package_volume']  . "\">" . $row['single_package_volume'] . " ml</option>";
            // }

            // while($row = mysqli_fetch_array($displayQuanityPerPackageResults)) 
            // {
            //     $selectQuanityPerPackage .= "<option value=\"" . $row['single_package_quantity']  . "\">" . $row['single_package_quantity'] . "</option>";
            // }

            ?>

<!--             <div class="form-group col-xs-4 col-no-padding-left">
                <label>Package Type</label>
                <select id="" name="inventory_package_type" class="form-control">
                    <option value="all">All Types</option>
                    <option value="Bottle">Bottle</option>
                    <option value="Can">Can</option>
                </select>
            </div>

            <div class="form-group col-xs-4">
                <label>Unit Volume</label>
                <select id="" name="inventory_package_single_volume" class="form-control">
                    <option value="all">All Volumes</option>
                    <?php echo $selectUnitVolume; ?>
                </select>
            </div>

            <div class="form-group col-xs-4 col-no-padding-right">
                <label>Quanity per Package</label>
                <select id="" name="inventory_package_quanity" class="form-control">
                    <option value="all">All Quantities</option>
                    <?php echo $selectQuanityPerPackage; ?>
                </select>
            </div> -->

            <div class="box-footer" style="padding-left:0px; padding-right: 0px">
                <button type="submit" class="btn btn-primary btn-block">Retrieve Historical Sales</button>
                <a href="?requestedAction=newSearch" style="margin-top: 10px" class="btn btn-primary btn-block">Clear Search</a>
            </div>
        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->




<script type="text/javascript">
    //Date range picker for putting the datepicker in the field to select the dates you want to use the data from
    $('#timespan_forecast_data_source').daterangepicker();
    //Date range picker for putting the datepicker in the field to select the dates you want to forecast for
    $('#timespan_forecast_for').daterangepicker();
</script>




<script type="text/javascript">
    // //Date range picker
    // // $('#timespanForInventoryLookup').daterangepicker(); TURNING THIS OFF BECUASE WE DON'T NEED A TIMESPAN HERE, JUST A SINGLE DATE.

    // //auto selecting values, if the page has been posted previously...
    // var requestedAction = getQueryVariable("requestedAction");
    // // http://stackoverflow.com/a/827378
    // function getQueryVariable(variable) {
    //     var query = window.location.search.substring(1);
    //     var vars = query.split("&");
    //     for (var i=0;i<vars.length;i++) {
    //         var pair = vars[i].split("=");
    //         if (pair[0] == variable) {
    //             return pair[1];
    //         }
    //     } 
    //     return '';
    // }

    // if(requestedAction ==="getHistoricalSales")
    // {
    //     var inventory_beerstore_id = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['inventory_beerstore_id']); ?>';
    //     var inventory_location = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['inventory_location']); ?>';
    //     var timespanForInventoryLookup = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['timespanForInventoryLookup']); ?>';
    //     var inventory_package_type = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['inventory_package_type']); ?>';
    //     var inventory_package_single_volume = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['inventory_package_single_volume']); ?>';
    //     var inventory_package_quanity = '<?php echo mysqli_real_escape_string(returnConnection(), $_POST['inventory_package_quanity']); ?>';

    //     $('select[name^="inventory_beerstore_id"] option[value="' + inventory_beerstore_id + '"]').attr("selected","selected");
    //     $('select[name^="inventory_location"] option[value="' + inventory_location + '"]').attr("selected","selected");
    //     $('#timespanForInventoryLookup').val(timespanForInventoryLookup);
    //     $('select[name^="inventory_package_type"] option[value="' + inventory_package_type + '"]').attr("selected","selected");
    //     $('select[name^="inventory_package_single_volume"] option[value="' + inventory_package_single_volume + '"]').attr("selected","selected");
    //     $('select[name^="inventory_package_quanity"] option[value="' + inventory_package_quanity + '"]').attr("selected","selected");
    // }


</script>































<!-- //crhsitians original code without modifications... -->

<form role="form" method="post" action="?requestedAction=forecast&viewName=results">
	<h3 class="box-title">How early do you want to consider in your forecast, and when do you want to forecast for?</h3>
	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
		<input type="text" class="form-control pull-right" id="reservation" name="reservation">
	</div>


	<h3 class="box-title">What beer package do you want to forecast for?</h3>
	<div class="form-group">
		<labelfor="beerType"></label>
                <label>Beer Name</label>
                <select id="" name="beerID" class="form-control">
                    <option>Select a Beer</option>
                    <?php
                    //getting names of the beers associated with this brewery
                    $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands WHERE brewery_id = '$loggedInBreweryID' AND beerstore_beer_id IN (SELECT DISTINCT beerstore_beer_id FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID')");

                    while($row = mysqli_fetch_array($displayTransactionQuery)) 
                    {
                        echo "<option value=\"" . $row['beerstore_beer_id']  . "\">" . $row['beer_name'] . "</option>";
                    }
                    ?>
                </select>
	</div>
	<!-- <div class="form-group">
	<labelfor="container">Select Container</label>
		<select class="form-control" id="container" name="container">
			<option>Bottle</option>
			<option>Can</option>
		</select>
	</div>
	<div class="form-group">
		<labelfor="volume">Select Volume</label>
		<select class="form-control" id="volume" name="volume">
			<option>Volume 1</option>
			<option>473</option>
			<option>341</option>
			<option>355</option>
			<option>...</option>
			<option>Volume 5</option>
		</select>
	</div>
	<div class="form-group">
        <labelfor="quantity">Select Package Quantity</label>
        <select class="form-control" id="quantity" name="quantity">
            <option>1</option>
            <option>6</option>
            <option>12</option>
            <option>24</option>
        </select>
    </div> -->

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
                <select id="container" name="container" class="form-control">
                    <!-- <option value="all">Choose a Package Type</option> -->
                    <option value="all">All Types</option>
                    <option value="Bottle">Bottle</option>
                    <option value="Can">Can</option>
                </select>
            </div>

            <div class="form-group col-xs-4">
                <label>Unit Volume</label>
                <select id="volume" name="volume" class="form-control">
                    <!-- <option value="all">Choose a Unit Volume</option> -->
                    <option value="all">All Volumes</option>
                    <?php echo $selectUnitVolume; ?>
                </select>
            </div>

            <div class="form-group col-xs-4 col-no-padding-right">
                <label>Quanity per Package</label>
                <select id="quantity" name="quantity" class="form-control">
                    <!-- <option value="all">Choose a Quanity</option> -->
                    <option value="all">All Quantities</option>
                    <?php echo $selectQuanityPerPackage; ?>
                </select>
            </div>


    <div class="box-footer">
        </br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


<!-- jQuery 2.1.3 -->
    <!-- Page script -->
    <script type="text/javascript">
     //Date range picker
        $('#reservation').daterangepicker();
    </script>