<?php
//HTML and any necessary PHP for generating the list of all beers in the table
include '../../_shared/_databaseConnection.php';
?>

<!-- Sample Data Table -->
<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Beer ID</th>
					<th>Beer Name</th>
					<th>Beer Price</th>
					<th>Beer Size</th>
					<th>Beer Type</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Trident</td>
					<td>Internet Explorer 4.0</td>
					<td>Win 95+</td>
					<td> 4</td>
					<td>X</td>
				</tr>
				<?php
              // SQL statement 
              $displayTransactionQuery = mysqli_query($primaryBeerTrackDB,"SELECT * 
                                                               FROM beer_brands b
                                                               WHERE b.beer_id =  '1' OR b.beer_id ='2'");
    
              while($row = mysqli_fetch_array($displayTransactionQuery)) {
              	echo "<tr>";
                echo "<td>" . $row['beer_id'] . "</td>";
                echo "<td>" . $row['beer_name'] . "</td>";
                echo "<td>" . $row['beer_price'] . "</td>";
                echo "<td>" . $row['beer_size'] . "</td>";
                echo "<td>" . $row['beer_type'] . "</td>";
                echo "</tr>";
              }
              ?>
			</tbody>
			<tfoot>
				<tr>
					<th>Rendering engine</th>
					<th>Browser</th>
					<th>Platform(s)</th>
					<th>Engine version</th>
					<th>CSS grade</th>
				</tr>
			</tfoot>
		</table>


	</div>
</div>

<script type="text/javascript">
	$(function() {
		$("#example1").dataTable();
	});
</script>

