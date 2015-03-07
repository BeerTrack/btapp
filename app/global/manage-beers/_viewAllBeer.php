<?php
//HTML and any necessary PHP for generating the list of all beers in the table
?>

<!-- Sample Data Table -->
<div class="row">
	<div class="col-xs-12">
		<table id="entireBeerTable" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Beer ID</th>
					<th>Beer Name</th>
					<th>Beer Price</th>
					<th>Beer Size</th>
					<th>Beer Type</th>
					<th>Beer Edit</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php
				$displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands b");

				while($row = mysqli_fetch_array($displayTransactionQuery)) {
					echo "<tr>";
					echo "<td>" . $row['beer_id'] . "</td>";
					echo "<td>" . $row['beer_name'] . "</td>";
					echo "<td>" . $row['beer_price'] . "</td>";
					echo "<td>" . $row['beer_size'] . "</td>";
					echo "<td>" . $row['beer_type'] . "</td>";
					echo "<td> <a href=\"?viewName=edit&beerId=" . $row['beer_id'] . "\">Edit</a></td>";
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
		$("#entireBeerTable").dataTable();
	});
</script>

