<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAfsoOmZeHXm5M4O_fMZWb9yL0VJBP6ZCU"></script>
<!-- <script src="gmaps_api.js"></script> -->
<script src="custom_phil.js"></script>

<?php 
// echo singleDayForecastGen("03/22/2015 - 04/04/2015", $row['beerstore_beer_id'], $row['beerstore_store_id'], $row['single_package_type'], $row['single_package_quantity'], $row['single_package_volume'])
echo ' test';
echo 'forcast' . singleDayForecastGen('03/25/2015 - 03/30/2015', '7911', '2314', 'Bottle', '6', '355');

?>
<div class="row">
	<div class="col-xs-12">
		<div class="panel box box-primary">
			<div class="box-header with-border">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">
						Shipping Manifest
					</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in" aria-expanded="false">
				<div class="box-body">
					<table id="allStoresTable" class="table table-hover table-bordered">
						<thead>
							<tr style="background-color: #ECECEC">
								<th>Beer</th>
								<th>Package Type</th>
								<th>Unit Volume</th>
								<th>Quanity per Package</th>
								<th>Current Inventory Level</th>
								<th>Quanity to Ship</th>
							</tr>
						</thead>
						<tbody>
							<?php
							function rowCreatorPerStore($loggedInBreweryID, $passedBeerStoreID, $storeNamePrint)
							{
								$possibleBeersQuery = beerTrackDBQuery(
									"SELECT s.location_name, bb.beer_name, ipd.single_package_type, ipd.single_package_volume, ipd.single_package_quantity, ipd.stock_at_timestamp, ipd.beerstore_store_id, ipd.beerstore_beer_id
									FROM stores s, beer_brands bb, inventory_parsing ipd
									WHERE 
									s.brewery_id = '$loggedInBreweryID' AND
									s.beerstore_store_id = '$passedBeerStoreID' AND
									ipd.brewery_id = s.brewery_id AND
									ipd.beerstore_beer_id = bb.beerstore_beer_id AND
									ipd.beerstore_store_id = s.beerstore_store_id
									ORDER BY s.location_name");

								echo '<tr style="background-color: #ECECEC"><td colspan="6"><strong>' . $storeNamePrint . '</strong>';
								echo '
								<div class="form-group" style="margin-bottom: 0px; float: right">
									<select id="decider_' . $passedBeerStoreID  . '" onChange="includeStoreCheck(\'' . $passedBeerStoreID . '\')" name="inventory_location" class="includeStoreCheck form-control storeHideStart">
										<option value="include">Include in Shipment Plan</option>
										<option value="exclude" selected>Exclude from Shipment Plan</option>
									</select>
								</div>
							</tr>';

							while($row = mysqli_fetch_array($possibleBeersQuery)) {
								echo "<tr style=\"display: none\" class=\"items_" . $passedBeerStoreID . "\">";
								echo "<td>" . $row['beer_name'] . "</td>";
								echo "<td>" . $row['single_package_type'] . "</td>";
								echo "<td>" . $row['single_package_volume'] . " ml</td>";
								echo "<td>" . $row['single_package_quantity'] . "</td>";
								// echo "<td>" . $row['stock_at_timestamp'] . " here's the forcast: " . singleDayForecastGen("03/22/2015 - 04/04/2015", $row['beerstore_beer_id'], $row['beerstore_store_id'], $row['single_package_type'], $row['single_package_quantity'], $row['single_package_volume']) . "</td>";
								echo "<td>" . $row['stock_at_timestamp'] . "</td>";
								echo "<td><input style=\"float:right; width:100%\" type=\"text\"></td>";
								echo "</tr>";
							}
						}

						$gMapsStoreListing = '';
						$gMapsStoreListingList = '';
						$possibleStoresQuery = beerTrackDBQuery("SELECT * FROM stores WHERE brewery_id = '$loggedInBreweryID'"); 
						while($singleStore = mysqli_fetch_array($possibleStoresQuery)) {
							rowCreatorPerStore($loggedInBreweryID, $singleStore['beerstore_store_id'], $singleStore['location_name']);
							$gMapsStoreListing .= '<option class="storeSelectOption notpicked" id="storeID_' . $singleStore['beerstore_store_id'] . '" value="' . $singleStore['location_address']  . '"> ' . $singleStore['location_name'] . '</option>';
							$gMapsStoreListingList .= '<p style="margin-bottom:0px" class="notpicked here" id="storeIDList_' . $singleStore['beerstore_store_id'] . '"> ' . $singleStore['location_name'] . '</p>';
						}
						?>
						</tbody>
					</table>
				</div>
				<div class="box-footer" style="display: block;">
					<div class="btn-group">
						<a id="collapseDeliveryToggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"  type="button" class="btn btn-primary collapsed" aria-expanded="false">
							Next Step
						</a>
        			</div>
				</div>
			</div>
		</div>
		<div class="panel box box-primary">
			<div class="box-header with-border">
				<h4 class="box-title">
					<a id="collapseDeliveryToggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
						Delivery Route
					</a>
				</h4>
			</div>
			<div id="collapseTwo" style="width: 100%" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
				<div class="box-body col-xs-12" >
					<div id="map-canvas" class="col-xs-8" style=""></div>

					<div id="control_panel" class="col-xs-4" style="float:right;">
						<div>
							<b>Start:</b>
							<p id="start">200 University Ave. West, Waterloo, ON</p>
							<b>Stores on Route:</b> <br>
								<?php 
									echo $gMapsStoreListingList;
								?>
							<p></p>
							<select class="gmapsStoreListing" multiple id="waypoints" style="display:none">
								<?php
									echo $gMapsStoreListing;
								?>
							</select>
							<b>End:</b>
							<p id="end">200 University Ave. West, Waterloo, ON</p>
							<!-- <input type="submit" onclick="calcRoute();"> -->
						</div>
						<div id="directions_panel" style="background-color:#FFEE77;"></div>
					</div> 	
				</div>
				<div class="box-footer" style="display: block;">
					<div class="btn-group">
						<a id="collapseDeliveryToggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"  type="button" class="btn btn-primary collapsed" aria-expanded="false">
							Next Step
						</a>
        			</div>
				</div>
			</div>
		</div>
		<div class="panel box box-primary">
			<div class="box-header with-border">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
						Finalize & Distribute Plan
					</a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
				<div class="box-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
				</div>
				<div class="box-footer" style="display: block;">
					<div class="btn-group">
						<a id="collapseDeliveryToggle" data-toggle="collapse" data-parent="#accordion" href=""  type="button" class="btn btn-primary collapsed" aria-expanded="false">
							Process Shipment
						</a>
        			</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	#map-canvas {
		height: 100%;
		margin: 0px;
		padding: 0px
	}
	#panel {
		position: absolute;
		top: 5px;
		left: 50%;
		margin-left: -180px;
		z-index: 5;
		background-color: #fff;
		padding: 5px;
		border: 1px solid #999;
	}
</style>




