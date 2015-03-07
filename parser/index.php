<?php

include '../app/_shared/_databaseConnection.php';
include '../assets/ganon.php';

//parses the size field to match our format...
function parseToMatchSiteshTable($size)
{
	echo '</br></br>';

	$locationOfBottle = strpos($size, 'Bottle');
	$locationOfCan = strpos($size, 'Can');

	if($locationOfBottle > 1)
	{
		$packageType = 'Bottle'; //Returned In Array...
		$volumeWithUnits = substr($size, ($locationOfBottle + 6), strlen($size));
		$quantityInPackage = trim(substr($size, 0, ($locationOfBottle - 3)));  //Returned In Array...
	}
	else
	{
		$packageType = 'Can'; //Returned In Array...
		$volumeWithUnits = substr($size, ($locationOfCan + 3), strlen($size));
		$quantityInPackage = trim(substr($size, 0, ($locationOfCan - 3)));  //Returned In Array...
	}

	$locationOfMl = strpos($volumeWithUnits, 'ml');
	$volumeML = trim(substr($volumeWithUnits, 0, $locationOfMl)); //Returned In Array...

	$sizeFormattedArray = array($quantityInPackage, $packageType, $volumeML);

	return $sizeFormattedArray;
}

//function for adding a record to the database
function recordInventory($location, $beer, $size, $inventory)
{
	$formattedSize = parseToMatchSiteshTable($size);
	$quantityInPackage = $formattedSize[0];
	$packageType = $formattedSize[1];
	$volumeML = $formattedSize[2];

	$recordStatement = "INSERT INTO inventory_parsing (beerstore_beer_id, beerstore_store_id, can_bottle_desc, single_package_type, single_package_quantity, single_package_volume, stock_at_timestamp)
	VALUES ('$beer', '$location', '$size', '$packageType', '$quantityInPackage', '$volumeML', '$inventory')";
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


//putting the beers into reaccesbile array
$arrayCountMaker = 0;
while($rowBeerBrand = mysqli_fetch_array($allBeerBrands)) {
	$beerBrandsArray[$arrayCountMaker] = $rowBeerBrand['beerstore_beer_id'];
	$arrayCountMaker++;
}


//putting the beers into reaccesbile array
$arrayCountMaker = 0;
while($rowBeerLocations = mysqli_fetch_array($allLocations)) {
	$beerLocationsArray[$arrayCountMaker] = $rowBeerLocations['beerstore_store_id'];
	$arrayCountMaker++;
}


//building the matrix of combinations
$arrayCountMaker = 0;
foreach ($beerLocationsArray as $location) {
	foreach ($beerBrandsArray as $brand) {
		$beerLocationMatrix[$arrayCountMaker] = array($location, $brand);
		$arrayCountMaker++;
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