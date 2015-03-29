<section class="col-lg-6 connectedSortable">
	<!-- Custom tabs (Charts with tabs)-->
	<div class="box box-primary homepage-dashboard-box">
			<div class="box-header">
				<h3 class="box-title">Yesturday's Sales</h3>
			</div>
			<div class="box-body">

			<table id="beerNoStoreFilter" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Beer</th>
						<th>Package</th>
						<th>Quantity Sold</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$todayTarget = date("Y-m-d");
					$dayBeforeTarget = date('Y-m-d', strtotime($todayTarget . ' - 1 days'));

					$listings = queryDatabaseForInventoryNoStoreFilter($dayBeforeTarget);
					while($row = mysqli_fetch_array($listings)) {
						echo "<tr>";
						echo "<td>" . $row['beer_name'] . "</td>";
						echo "<td>" . $row['can_bottle_desc'] . "</td>";
						echo "<td class=\"calcSalesThatDayNoStoreFilter\">" . calcSalesThatDayNoStoreFilter($row['beerstore_beer_id'], $row['run_timestamp'], $row['can_bottle_desc'], $row[7]) . "</td>";
						echo "</tr>";
					}

					?>
				</tbody>

			</table>

		</div>
	</div>
</section>


<script type="text/javascript">
	$(function() {
		$("#beerNoStoreFilter").dataTable( {
		});
	});
</script>




<?php
// $uniqueBeers = beerTrackDBQuery("SELECT DISTINCT beerstore_beer_ID, single_package_type, single_package_volume, single_package_quantity FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID'");

// while($beers = mysqli_fetch_array($uniqueBeers)) {
//     echo $beers['beerstore_beer_ID'] . '</br>';
//     echo $beers['single_package_type'] . '</br>';
//     echo $beers['single_package_volume'] . '</br>';
//     echo $beers['single_package_quantity'] . '</br>';
// }
?>

<!-- <table id="allStoresTable" class="table table-bordered table-striped">
<thead>
<tr>
<th>Date</th>
<th>Beer</th>
<th>Location</th>
<th>Package Type</th>
<th>Unit Volume</th>
<th>Quanity per Package</th>
<th>Packages Sold</th>
</tr>
</thead>
<tbody> -->
	<?php

// $listings = queryDatabaseForLatestInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity);

// while($row = mysqli_fetch_array($listings)) {
//     // print_r($row);
//     echo "<tr>";
//     echo "<td>" . substr($row['run_timestamp'], 0, 10) . "</td>";
//     echo "<td>" . $row['beer_name'] . "</td>";
//     echo "<td>" . $row['location_name'] . "</td>";
//     echo "<td>" . $row['single_package_type'] . "</td>";
//     echo "<td>" . $row['single_package_volume'] . " ml</td>";
//     echo "<td>" . $row['single_package_quantity'] . "</td>";
//     // echo "<td>" . $row['stock_at_timestamp'] . "</td>";
//     echo "<td>" . calcSalesThatDay($row[2], $row[3], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";

//     // echo "<td>" . calcSalesThatDay($row['beerstore_beer_ID'], $row['beerstore_store_ID'], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";
//     // echo "<td class=\"options-align-right\"> <a href=\"?viewName=edit&storeId=" . $row['store_id'] . "\"><button class=\"btn btn-xs btn-primary\">Edit Store</button></a></td>";
//     echo "</tr>";

// }

	?>
<!--               </tbody>

</table>
-->
