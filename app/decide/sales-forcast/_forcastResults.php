<?php

echo '<h2>hi</h2>';
//echo ' The forecasted number of sales is: ' . singleDayForecastGen($textDateRange, $beerID, $storeID, $container, $quantity, $volume);

//getting names of the beers associated with this brewery
$stores = beerTrackDBQuery("SELECT DISTINCT beerstore_store_id, single_package_type, single_package_quantity, single_package_volume
FROM inventory_parsing
WHERE beerstore_beer_id = 3066");

$total = 0;
while($row = mysqli_fetch_array($stores)) 
{
	$temp = 341 * 12 * singleDayForecastGen($textDateRange, 3066, $row['beerstore_store_id'], 'Bottle', 12, 341);
	echo 'this stores volume: ' . $temp . '</br>';

	$total = $total + $temp;
	echo 'running total is:' . $total . '</br> ';
}
echo $total;

// echo ' next 3 days forcasted values: </br>';

// echo 'forcast for the 16th: ' . christiansThing('03/02/2015 - 03/16/2015') . '</br>';
// echo 'forcast for the 17th: ' . christiansThing('03/02/2015 - 03/17/2015') . '</br>';
// echo 'forcast for the 18th: ' . christiansThing('03/02/2015 - 03/18/2015') . '</br>';

?>