<?php
$dataOfPhilAndChristian = array(
array("a", 100),
array("hose", 96),
array(31, 98),
array(41, 103),
array(51, 100),
array(61, 103),
array(71, 109),
array(81, 106),
array(91, 105),
array(101, 106),
array(111, 109),
array(121, 117),
array(131, 113),
array(141, 113)
);

//Converts array passed in from database
$count = 1;
foreach ($dataOfPhilAndChristian as &$row) {
	$row[0] = $count;
	echo "(" . $dataOfPhilAndChristian[$count - 1][0] . ", " . $dataOfPhilAndChristian[$count - 1][1] . ")";
	$count = $count + 1;
};

//Get start, current, and end dates
$dateRange = addDateRange();
echo "</br>" . "start date is: " . $dateRange[0];
echo "</br>" . "current date is: " .  $dateRange[1];
echo "</br>" . "end date is: " . $dateRange[2];
//Determines number of days ahead the forecast is to be made for
$daysAhead = ceil(abs((strtotime($dateRange[2]) - strtotime($dateRange[1])) / 86400));
echo "</br>" . "num days ahead is: " . $daysAhead . "</br>";


//Linear regression forecast
$slopeAndY = basicForcast($dataOfPhilAndChristian);
$LRforecast = ((floatval($slopeAndY[1]) * (count($dataOfPhilAndChristian) + $daysAhead)) + floatval($slopeAndY[0]));
//Moving average forecast
$sum = 0;
foreach ($dataOfPhilAndChristian as list($date, $sales)) {
	$sum = $sum + $sales;
	};
$Aforecast = $sum / count($dataOfPhilAndChristian);
//Output total forecast based 80% on the MA forecast and 20% on the LR forecast
echo "Predicted number of sales for " . $dateRange[2] . " is: " . (0.8 * floatval($Aforecast) + 0.2 * floatval($LRforecast));

// $data = getDateAndStockLevels('2015-03-02', '2015-03-03', '3211', '2322', 'Bottle', '12', '341');
    
?>



<form role="form" method="post" action="?requestedAction=forecast">
	<div class="input-group">
		<div class="input-group-addon">
			<i class="fa fa-calendar"></i>
		</div>
		<input type="text" class="form-control pull-right" id="reservation" name="reservation">
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
            <div id="line-chart" style="height: 300px;"></div>
        </div><!-- /.box-body-->
    </div><!-- /.box -->
</div>


<!-- jQuery 2.1.3 -->

    <!-- Page script -->
    <script type="text/javascript">
     //Date range picker
        $('#reservation').daterangepicker();
        // $(function() {
        //     /*
        //      * LINE CHART
        //      * ----------
        //      */
        //     //LINE randomly generated data

        //     var sin = [], cos = [];
        //     for (var i = 0; i < 14; i += 0.5) {
        //         sin.push([i, Math.sin(i)]);
        //         cos.push([i, Math.cos(i)]);
        //     }
        //     var line_data1 = {
        //         data: sin,
        //         color: "#3c8dbc"
        //     };
        //     var line_data2 = {
        //         data: cos,
        //         color: "#00c0ef"
        //     };
        //     $.plot("#line-chart", [line_data1, line_data2], {
        //         grid: {
        //             hoverable: true,
        //             borderColor: "#f3f3f3",
        //             borderWidth: 1,
        //             tickColor: "#f3f3f3"
        //         },
        //         series: {
        //             shadowSize: 0,
        //             lines: {
        //                 show: true
        //             },
        //             points: {
        //                 show: true
        //             }
        //         },
        //         lines: {
        //             fill: false,
        //             color: ["#3c8dbc", "#f56954"]
        //         },
        //         yaxis: {
        //             show: true,
        //         },
        //         xaxis: {
        //             show: true
        //         }
        //     });
        //     //Initialize tooltip on hover
        //     $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
        //         position: "absolute",
        //         display: "none",
        //         opacity: 0.8
        //     }).appendTo("body");
        //     $("#line-chart").bind("plothover", function(event, pos, item) {

        //         if (item) {
        //             var x = item.datapoint[0].toFixed(2),
        //                     y = item.datapoint[1].toFixed(2);

        //             $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
        //                     .css({top: item.pageY + 5, left: item.pageX + 5})
        //                     .fadeIn(200);
        //         } else {
        //             $("#line-chart-tooltip").hide();
        //         }

        //     });
        //     /* END LINE CHART */
        // });
        // /*
        //  * Custom Label formatter
        //  * ----------------------
        //  */
        // function labelFormatter(label, series) {
        //     return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
        //         + label
        //         + "<br/>"
        //         + Math.round(series.percent) + "%</div>";
	       //  }
    </script>