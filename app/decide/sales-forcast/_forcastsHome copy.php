<?php
//Get start, current, and end dates

?>



<form role="form" method="post" action="?requestedAction=forecast&viewName=results">
	<h3 class="box-title">How early do you want to consider in your forecast, and when do you want to forecast for?</h3>
	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
		<input type="text" class="form-control pull-right" id="reservation" name="reservation">
	</div>
	<h3 class="box-title">What store do you want to forecast for?</h3>

    <div class="form-group col-xs-12">
        <label>Location</label>
        <select id="" id="store" name="store" class="form-control">
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

<div class="col-md-8">

    <!-- Line chart -->
    <div class="box box-primary">
        <div class="box-header">
            <i class="fa fa-bar-chart-o"></i>
            <h3 class="box-title">History and Forecast Chart</h3>
        </div>
        <div class="box-body">
              <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                        </div>
                    </div><!-- /.nav-tabs-custom -->
                </section>
                <!-- </div> -->
        </div><!-- /.box-body-->
    </div><!-- /.box -->
</div>

<!-- jQuery 2.1.3 -->
    <!-- Page script -->
    <script type="text/javascript">
     //Date range picker
        $('#reservation').daterangepicker();
    </script>