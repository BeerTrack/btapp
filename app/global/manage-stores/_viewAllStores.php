<?php
//HTML and any necessary PHP for generating the list of all stores in the table
?>

<!-- Sample Data Table -->
<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Rendering engine</th>
					<th>Browser</th>
					<th>Platform(s)</th>
					<th>Engine version</th>
					<th>CSS grade</th>
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
				<tr>
					<td>Trident</td>
					<td>Internet Explorer 5.0</td>
					<td>Win 95+</td>
					<td>5</td>
					<td>C</td>
				</tr>
				<tr>
					<td>Trident</td>
					<td>Internet Explorer 5.5</td>
					<td>Win 95+</td>
					<td>5.5</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Trident</td>
					<td>Internet Explorer 6</td>
					<td>Win 98+</td>
					<td>6</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Trident</td>
					<td>Internet Explorer 7</td>
					<td>Win XP SP2+</td>
					<td>7</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Trident</td>
					<td>AOL browser (AOL desktop)</td>
					<td>Win XP</td>
					<td>6</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Firefox 1.0</td>
					<td>Win 98+ / OSX.2+</td>
					<td>1.7</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Firefox 1.5</td>
					<td>Win 98+ / OSX.2+</td>
					<td>1.8</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Firefox 2.0</td>
					<td>Win 98+ / OSX.2+</td>
					<td>1.8</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Firefox 3.0</td>
					<td>Win 2k+ / OSX.3+</td>
					<td>1.9</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Camino 1.0</td>
					<td>OSX.2+</td>
					<td>1.8</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Camino 1.5</td>
					<td>OSX.3+</td>
					<td>1.8</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Netscape 7.2</td>
					<td>Win 95+ / Mac OS 8.6-9.2</td>
					<td>1.7</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Netscape Browser 8</td>
					<td>Win 98SE+</td>
					<td>1.7</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Netscape Navigator 9</td>
					<td>Win 98+ / OSX.2+</td>
					<td>1.8</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Mozilla 1.0</td>
					<td>Win 95+ / OSX.1+</td>
					<td>1</td>
					<td>A</td>
				</tr>
				<tr>
					<td>Gecko</td>
					<td>Mozilla 1.1</td>
					<td>Win 95+ / OSX.1+</td>
					<td>1.1</td>
					<td>A</td>
				</tr>
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

