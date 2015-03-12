<?php
//Get start, current, and end dates
$dateRange = addDateRange();
echo "</br>" . "start date is: " . $dateRange[0];
echo "</br>" . "current date is: " .  $dateRange[1];
echo "</br>" . "end date is: " . $dateRange[2];
//Determines number of days ahead the forecast is to be made for
$daysAhead = ceil(abs((strtotime($dateRange[2]) - strtotime($dateRange[1])) / 86400));
echo "</br>" . "num days ahead is: " . $daysAhead . "</br>";

//Note: changed "$dataOfPhilAndChristian" to $stockLevels
// $dataOfPhilAndChristian = array(
// array("a", 100),
// array("hose", 96),
// array(31, 98),
// array(41, 103),
// array(51, 100),
// array(61, 103),
// array(71, 109),
// array(81, 106),
// array(91, 105),
// array(101, 106),
// array(111, 109),
// array(121, 117),
// array(131, 113),
// array(141, 113)
// );

$startDate = date_create($dateRange[0]);
print_r($startDate);
$endDate = date_create($dateRange[2]);
$stockLevels = getDateAndStockLevels('2015-03-02', date_format($endDate,"Y-m-d"), '3211', '2322', 'Bottle', '12', '341');
echo "</br>";
print_r($stockLevels);
echo "</br>";

//Converts array passed in from database
echo "Converted data array: ";
$count = 1;
foreach ($stockLevels as &$row) {
	$row[0] = $count;
	echo "(" . $stockLevels[$count - 1][0] . ", " . $stockLevels[$count - 1][1] . ")";
	$count = $count + 1;
};

//Linear regression forecast
$slopeAndY = basicForcast($stockLevels);
$LRforecast = ((floatval($slopeAndY[1]) * (count($stockLevels) + $daysAhead)) + floatval($slopeAndY[0]));
//Moving average forecast
$sum = 0;
foreach ($stockLevels as list($date, $sales)) {
	$sum = $sum + $sales;
	};
$Aforecast = $sum / count($stockLevels);
//Output total forecast based 80% on the MA forecast and 20% on the LR forecast
echo "</br> Predicted number of sales for " . $dateRange[2] . " is: " . (0.8 * floatval($Aforecast) + 0.2 * floatval($LRforecast));
    
?>



<form role="form" method="post" action="?requestedAction=forecast">
	<h3 class="box-title">How early do you want to consider in your forecast, and when do you want to forecast for?</h3>
	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
		<input type="text" class="form-control pull-right" id="reservation" name="reservation">
	</div>
	<h3 class="box-title">What store do you want to forecast for?</h3>
	<div class="form-group">
		<labelfor="store">Select Store</label>
		<select class="form-control" id="store" name="store">
			<option>Main Store Address</option>
			<option>Beer Store 1 Address</option>
			<option>Beer Store 2 Address</option>
			<option>Beer Store 3 Address</option>
			<option>Beer Store 4 Address</option>
			<option>Beer Store 5 Address</option>
		</select>
	</div>
	<h3 class="box-title">What beer package do you want to forecast for?</h3>
	<div class="form-group">
		<labelfor="beerType">Select Beer Type</label>
		<select class="form-control" id="beerType" name="beerType">
			<option>Beer 1 Name</option>
			<option>Beer 2 Name</option>
			<option>Beer 3 Name</option>
			<option>Beer 4 Name</option>
			<option>...</option>
			<option>Beer 5 Name</option>
		</select>
	</div>
	<div class="form-group">
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
			<option>Volume 2</option>
			<option>Volume 3</option>
			<option>Volume 4</option>
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
    </div>
    <div class="box-footer">
        </br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<div class="col-md-8">
	<p class="text-center">
	    <strong>
	    	Sales: 
	    	<?php 
	    		$dateRange = addDateRange();
	    		echo $dateRange[0] . " till " . $dateRange[2];
    		?>
    	</strong>
	</p>

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