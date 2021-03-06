
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">All Notifications</h3>
			</div>
			<div class="box-body">       
				<table id="allStoresTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Date</th>
							<th>Subject</th>
							<th>Body</th>
							<th>Options</th>
						</tr>
					</thead>s
					<tbody>
					<?php
					// queries the database and returns this breweries unread notifications
					$displayTransactionQuery = beerTrackDBQuery("SELECT * FROM notifications WHERE status = 1 AND brewery_id = '$loggedInBreweryID' ORDER BY createdTimestamp");

					while($row = mysqli_fetch_array($displayTransactionQuery)) {
						echo "<tr>";
						echo "<td>" . $row['createdTimestamp'] . "</td>";
						echo "<td>" . $row['subject'] . "</td>";
						echo "<td>" . $row['body'] . "</td>";
						echo "<td class=\"options-align-right\"> <a href=\"?viewName=notifications&requestedAction=dismissNotifcation&notificationID=" . $row['id'] . "\"> <button class=\"btn btn-xs btn-primary\"> Dismiss</button> </a></td>";
						echo "</tr>";
					}
					?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>