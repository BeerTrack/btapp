<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">All Beers</h3>
			</div>
			<div class="box-body"> 
				<table id="entireBeerTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Beer Name</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$displayTransactionQuery = beerTrackDBQuery("SELECT * FROM beer_brands WHERE brewery_id = '$loggedInBreweryID'");

						while($row = mysqli_fetch_array($displayTransactionQuery)) {
							echo "<tr>";
							echo "<td>" . $row['beer_name'] . "</td>";
							echo "<td class=\"options-align-right\"> <a href=\"?viewName=edit&beerId=" . $row['beer_id'] . "\"><button class=\"btn btn-xs btn-primary\">Edit Beer</button></a></td>";
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
//function that lets us have sortable tables and filter them based on the results displayed in it.
$(function() {
	$("#entireBeerTable").dataTable( {
		"aoColumnDefs": [
		{ 'bSortable': false, 'aTargets': [ -1 ] }
		]
	});
});
</script>

