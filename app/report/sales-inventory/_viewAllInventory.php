
	<script type="text/javascript" language="javascript" src="dataTables.tableTools.js"></script>
	<script type="text/javascript" language="javascript" src="dataTables.tableTools.css"></script>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Inventory Data</h3>
			</div>
			<div class="box-body">
				<table id="allStoresTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Updated Date</th>
							<th>Package Type</th>
							<th>Unit Volume</th>
							<th>Quanity per Package</th>
							<th>Inventory Level</th>
						</tr>
					</thead>
					<tbody>
					<?php

					$listings = queryDatabaseForSalesInventory($inventory_beerstore_id, $inventory_location, $inventoryLookupDay, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity);
					
					while($row = mysqli_fetch_array($listings)) {
						echo "<tr>";
						echo "<td>" . substr($row['run_timestamp'], 0, 10) . "</td>";
						echo "<td>" . $row['single_package_type'] . "</td>";
						echo "<td>" . $row['single_package_volume'] . " ml</td>";
						echo "<td>" . $row['single_package_quantity'] . "</td>";
						echo "<td>" . $row['stock_at_timestamp'] . "</td>";
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
	
	$(document).ready( function () {
    var table = $('#allStoresTable').dataTable();
    var tableTools = new $.fn.dataTable.TableTools( table, {
        "buttons": [
            "copy",
            "csv",
            "xls",
            "pdf",
            { "type": "print", "buttonText": "Print me!" }
        ]
    } );
      
    $( tableTools.fnContainer() ).insertAfter('div.box-title');
} );

	
</script>

<script type="text/javascript">
	// $(function() {
	// 	$("#allStoresTable").dataTable( {
	// 		"aoColumnDefs": [
	// 		{ 'bSortable': false, 'aTargets': [ -1 ] }
	// 		]
	// 	});
	// });
</script>

