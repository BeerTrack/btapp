<?php
//HTML and any necessary PHP for generating the list of all stores in the table
?>

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
					$displayTransactionQuery = beerTrackDBQuery("SELECT * FROM stores ORDER BY location_name");

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

<script type="text/javascript">
	$(function() {
		$("#allStoresTable").dataTable( {
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ -1 ] }
       ]
});
	});
</script>

