<?php
$dataOfPhilAndChristian = array(
array(1, 100),
array(2, 96),
array(3, 98),
array(4, 103),
array(5, 100),
array(6, 103),
array(7, 109),
array(8, 106),
array(9, 105),
array(10, 106),
array(11, 109),
array(12, 117),
array(13, 113),
array(14, 113)
);


$daysAhead = 7;

$slopeAndY = basicForcast($dataOfPhilAndChristian);

// echo 'slope: ' . $slopeAndY[1];
// echo '</br>y intercept: ' . $slopeAndY[0];
// echo '</br>LR Forecast: ' . ((floatval($slopeAndY[1]) * (count($dataOfPhilAndChristian) + $daysAhead)) + floatval($slopeAndY[0]));

$LRforecast = ((floatval($slopeAndY[1]) * (count($dataOfPhilAndChristian) + $daysAhead)) + floatval($slopeAndY[0]));

$sum = 0;

foreach ($dataOfPhilAndChristian as list($date, $sales)) {
	$sum = $sum + $sales;
	};

	// echo '</br>A Forecast: ' . $sum / count($dataOfPhilAndChristian);

$Aforecast = $sum / count($dataOfPhilAndChristian);

// echo '</br>Final Forecast: ' . (0.8 * floatval($Aforecast) + 0.2 * floatval($LRforecast));
echo (0.8 * floatval($Aforecast) + 0.2 * floatval($LRforecast));
?>