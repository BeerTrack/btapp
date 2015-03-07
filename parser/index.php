<?php

include '../app/_shared/_databaseConnection.php';
include '../assets/ganon.php';

//function for adding a record to the database
function recordInventory($location, $beer, $size, $inventory)
{
	$recordStatement = "INSERT INTO inventory_parsing (beerstore_beer_id, beerstore_store_id, can_bottle_desc, stock_at_timestamp)
	VALUES ('$beer', '$location', '$size', '$inventory')";
	beerTrackDBQuery($recordStatement);
}

//getting entries from DB
$allBeerBrands = beerTrackDBQuery("SELECT beerstore_beer_id FROM beer_brands WHERE instance_id = 1");
$allLocations = beerTrackDBQuery("SELECT beerstore_store_id FROM stores WHERE instance_id = 1");

//the array we'll use to store the combinations of locations and beers
$beerLocationMatrix = array();

//individual arrays to store reaccessible data...
$beerBrandsArray = array();
$beerLocationsArray = array();

//counter we reuse alot
$arrayCountMaker = 0;

//putting the beers into reaccesbile array
while($rowBeerBrand = mysqli_fetch_array($allBeerBrands)) {
	$beerBrandsArray[$arrayCountMaker] = $rowBeerBrand['beerstore_beer_id'];
	$arrayCountMaker++;
}

$arrayCountMaker = 0;

//putting the beers into reaccesbile array
while($rowBeerLocations = mysqli_fetch_array($allLocations)) {
	$beerLocationsArray[$arrayCountMaker] = $rowBeerLocations['beerstore_store_id'];
	$arrayCountMaker++;
}

$arrayCountMaker = 0;

//building the matrix of combinations
foreach ($beerLocationsArray as $location) {
	foreach ($beerBrandsArray as $brand) {
		$beerLocationMatrix[$arrayCountMaker] = array($location, $brand);
		$arrayCountMaker++;

		// echo 'location: ' . $location . '</br>';
		// echo 'beer brand: ' . $brand . '</br>';
	}
}

//parsing and calling the function to add the record to the DB
foreach ($beerLocationMatrix as $matrixCombo) {

	$location = $matrixCombo[0];
	$beer = $matrixCombo[1];

	$beerStoreDOM = file_get_dom('http://www.thebeerstore.ca/beers/inventory/' . $beer . '/' . $location);

	echo '</br></br>';
	echo 'Location: ' . $location . '</br>';
	echo 'Beer: ' . $beer . '</br>';
	echo '</br>';

	 foreach($beerStoreDOM('table tbody tr') as $row) {
	 	  
	 	  $size = null;
	 	  $inventory = null;
	 	  foreach($row('td') as $justRowsTD) {
	 	  	if ($justRowsTD->class == 'size') {
	 	  		$size = $justRowsTD->getPlainText();

	 	  		echo 'Size: ' . $justRowsTD->getPlainText(), "<br>\n";
	 	  	}
	 	  	if ($justRowsTD->class == 'inventory') {
	 	  		$inventory = $justRowsTD->getPlainText();

	 	  		echo 'Inventory: ' . $justRowsTD->getPlainText(), "<br>\n";
	 	  	}
	 	  	if($size != null && $inventory != null)
	 	  	{
	 	  		recordInventory($location, $beer, $size, $inventory);
	 	  	}
		  }
	 }
 }

?>