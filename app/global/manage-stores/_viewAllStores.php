<!-- Sample Data Table -->
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">All Stores</h3>
				<!-- <a href="?viewName=add"><button class="box-header-btn btn btn-primary">Add Store</button></a> -->
			</div>
			<div class="box-body">       
				<table id="allStoresTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Location Name</th>
							<th>Location Address</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
					<?php
					
					//Populate the dropdown menus for each othe questions with informatiion from the query
					$displayTransactionQuery = beerTrackDBQuery("SELECT * FROM stores WHERE brewery_id = '$loggedInBreweryID' ORDER BY location_name");

					while($row = mysqli_fetch_array($displayTransactionQuery)) {
						echo "<tr>";
						echo "<td>" . $row['location_name'] . "</td>";
						echo "<td>" . $row['location_address'] . "</td>";
						echo "<td class=\"options-align-right\"> <a href=\"?viewName=edit&storeId=" . $row['store_id'] . "\"><button class=\"btn btn-xs btn-primary\">Edit Store</button></a></td>";
						echo "</tr>";
					}
					?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>

<!-- Implements DataTables plugin in main view all table -->
<script type="text/javascript">
	$(function() {
		$("#allStoresTable").dataTable( {
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ -1 ] }
       ]
});
	});
</script>

