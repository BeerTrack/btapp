<?php

echo '</br> timespan_forecast_data_source_dates: ' . $timespan_forecast_data_source_dates;
echo '</br> timespan_forecast_for: ' . $timespan_forecast_for;

echo '</br> start_timespan_forecast_data_source: ' . $start_timespan_forecast_data_source;
echo '</br> start_timespan_forecast_for: ' . $start_timespan_forecast_for;
echo '</br> end_timespan_forecast_for: ' . $end_timespan_forecast_for;

echo '</br>selected_beerstore_beer_id: ' . $selected_beerstore_beer_id;

$dateRangeFed = $start_timespan_forecast_data_source . " - " . $start_timespan_forecast_for;

echo '</br>dateRangeFed: ' . $dateRangeFed;

echo '</br></br></br>';




//getting all the unique packaging for each of the beerstores this beer is sold at
$combosFromBeerStoreBeerID = beerTrackDBQuery("
		SELECT DISTINCT beerstore_store_id, beerstore_beer_id, single_package_type, single_package_quantity, single_package_volume
		FROM inventory_parsing ipMain
		WHERE beerstore_beer_id = '$selected_beerstore_beer_id' AND 
		EXISTS
			(
				SELECT * FROM inventory_parsing ipSub 
				WHERE 
				ipSub.beerstore_beer_id = ipMain.beerstore_beer_id AND
				ipSub.beerstore_store_id = ipMain.beerstore_store_id AND
				ipSub.single_package_type = ipMain.single_package_type AND
				ipSub.single_package_quantity = ipMain.single_package_quantity AND
				ipSub.single_package_volume = ipMain.single_package_volume AND 
				ipSub.stock_at_timestamp > 0
			)
	");

$totalVolumeThisBeer = 0;
while($unique_BeerIDPackageQuantityVolume = mysqli_fetch_array($combosFromBeerStoreBeerID)) 
{
	$packagesForThisCombo = singleDayForecastGen($dateRangeFed, $unique_BeerIDPackageQuantityVolume['beerstore_beer_id'], $unique_BeerIDPackageQuantityVolume['beerstore_store_id'], $unique_BeerIDPackageQuantityVolume['single_package_type'], $unique_BeerIDPackageQuantityVolume['single_package_quantity'], $unique_BeerIDPackageQuantityVolume['single_package_volume']);
	echo '</br> Store: ' . $unique_BeerIDPackageQuantityVolume['beerstore_store_id'];
	echo '</br> Q: ' . $unique_BeerIDPackageQuantityVolume['single_package_quantity'];
	echo '</br>packagesForThisCombo: ' . $packagesForThisCombo;

	$volumeForThisCombo = $unique_BeerIDPackageQuantityVolume['single_package_quantity'] * $unique_BeerIDPackageQuantityVolume['single_package_volume'] * $packagesForThisCombo;
	echo '</br>This combos volume: ' . $volumeForThisCombo . '</br>';

	$totalVolumeThisBeer = $totalVolumeThisBeer + $volumeForThisCombo;
	echo 'running totalVolumeThisBeer is:' . $totalVolumeThisBeer . '</br> ';
}

echo '</br></br>Very End Total:' . $totalVolumeThisBeer;

?>