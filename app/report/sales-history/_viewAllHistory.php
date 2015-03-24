<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Historical Sales Data</h3>
			</div>
			<div class="box-body">
				<table id="allStoresTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Date</th>
							<th>Beer</th>
							<th>Location</th>
							<th>Package Type</th>
							<th>Unit Volume</th>
							<th>Quanity per Package</th>
							<!-- <th>Packages Sold</th> -->
							<th>Packages Sold</th>
						</tr>
					</thead>
					<tbody>
					<?php

					$listings = queryDatabaseForLatestInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity);
					
					while($row = mysqli_fetch_array($listings)) {
						// print_r($row);
						echo "<tr>";
						echo "<td>" . substr($row['run_timestamp'], 0, 10) . "</td>";
						echo "<td>" . $row['beer_name'] . "</td>";
						echo "<td>" . $row['location_name'] . "</td>";
						echo "<td>" . $row['single_package_type'] . "</td>";
						echo "<td>" . $row['single_package_volume'] . " ml</td>";
						echo "<td>" . $row['single_package_quantity'] . "</td>";
						// echo "<td>" . $row['stock_at_timestamp'] . "</td>";
						echo "<td>". calcSalesThatDay($row[3], $row[4], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";
						
						// echo "<td>" . calcSalesThatDay($row['beerstore_beer_ID'], $row['beerstore_store_ID'], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";
						// echo "<td class=\"options-align-right\"> <a href=\"?viewName=edit&storeId=" . $row['store_id'] . "\"><button class=\"btn btn-xs btn-primary\">Edit Store</button></a></td>";
						echo "</tr>";

					}

					?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$("#allStoresTable").dataTable( {
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ -1 ] }
       ]
});
	});
</script>

