<?php
//HTML and any necessary PHP for generating the list of all stores in the table
?>

<!-- Sample Data Table -->
<div class="row">
	<div class="col-xs-12">
		<table id="allStoresTable" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Location Name</th>
					<th>Location Address</th>
					<th>Store Edit</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php
				$displayTransactionQuery = beerTrackDBQuery("SELECT * FROM stores s");

				while($row = mysqli_fetch_array($displayTransactionQuery)) {
					echo "<tr>";
					echo "<td>" . $row['location_name'] . "</td>";
					echo "<td>" . $row['location_address'] . "</td>";
					echo "<td> <a href=\"?viewName=edit&storeId=" . $row['store_id'] . "\">Edit</a></td>";
					echo "</tr>";
				}
				?>
				</tr>
			</tbody>

		</table>


	</div>
</div>

<script type="text/javascript">
	$(function() {
		$("#allStoresTable").dataTable();
	});
</script>

