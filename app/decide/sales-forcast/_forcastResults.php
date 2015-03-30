<?php

$dateRangeFed = $start_timespan_forecast_data_source . " - " . $start_timespan_forecast_for;

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
?>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Forecasted Beer Sales</h3>
			</div>
			<div class="box-body">
				<table id="allStoresTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Location Name</th>
							<th>Package Type</th>
							<th>Unit Volume (ml)</th>
							<th>Quanity per Package</th>
							<th>Forcasted Sales (# of packages)</th>
							<th>Forcasted Sales (in Liters)</th>
						</tr>
					</thead>
					<tbody>

					<?php
					$totalVolumeThisBeer = 0; //starting variable to keep track of total volume

					//looping through the array of data containing the beer sales information. Returned from mysqli_fetch_array, which contained the data returned from the query above (line 5)
					while($unique_BeerIDPackageQuantityVolume = mysqli_fetch_array($combosFromBeerStoreBeerID)) 
					{
						$packagesForThisCombo = round(singleDayForecastGen($dateRangeFed, $unique_BeerIDPackageQuantityVolume['beerstore_beer_id'], $unique_BeerIDPackageQuantityVolume['beerstore_store_id'], $unique_BeerIDPackageQuantityVolume['single_package_type'], $unique_BeerIDPackageQuantityVolume['single_package_quantity'], $unique_BeerIDPackageQuantityVolume['single_package_volume']), 2);
						$volumeForThisCombo = round($unique_BeerIDPackageQuantityVolume['single_package_quantity'] * $unique_BeerIDPackageQuantityVolume['single_package_volume'] * $packagesForThisCombo, 2);
						$totalVolumeThisBeer = round($totalVolumeThisBeer + $volumeForThisCombo,2);

						//printing each table row as needed
						echo '</tr>';
						echo '<td> Beerstore #' . $unique_BeerIDPackageQuantityVolume['beerstore_store_id'] . '</td>';
						echo '<td>' . $unique_BeerIDPackageQuantityVolume['single_package_type'] . '</td>';
						echo '<td>' . $unique_BeerIDPackageQuantityVolume['single_package_volume'] . '</td>';
						echo '<td>' . $unique_BeerIDPackageQuantityVolume['single_package_quantity'] . '</td>';
						echo '<td>' . $packagesForThisCombo . '</td>';
						echo '<td>' . round(($volumeForThisCombo / 1000),2) . ' L</td>'; //converting the volume to liters
						echo '</tr>';
					}
					?>

					<tr>
						<td colspan="5" align="right">Total Beer Required on <?php echo substr($dateRangeFed, 13); ?>: </td>
						<td><?php echo round(($totalVolumeThisBeer/1000), 2); //converting the volume to liters ?> L</td>
					</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>