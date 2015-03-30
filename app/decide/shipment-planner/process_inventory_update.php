<?php
// include '../../_shared/_auth.php';
include '../../_shared/_databaseConnection.php';
include '../../_shared/_globalFunctions.php';


$breweryIDPassed = mysqli_real_escape_string(returnConnection(), $_GET['breweryIDPassed']);
$beerIDPassed = mysqli_real_escape_string(returnConnection(), $_GET['beerIDPassed']);
$inventory_package_option = mysqli_real_escape_string(returnConnection(), $_GET['inventory_package_option']);
$quantity_ordered = mysqli_real_escape_string(returnConnection(), $_GET['quantity_ordered']);
$location =  mysqli_real_escape_string(returnConnection(), $_GET['location']);
$run_timestamp = date('Y-m-d H:i:s', (time()));
echo $location;


echo ' hi!!!';

//Get latest entry in Inventory parsing table 
$queryWord = "SELECT * FROM inventory_parsing_trying_something WHERE beerstore_beer_id = '$beerIDPassed' and beerstore_store_id = '$location' and can_bottle_desc = '$inventory_package_option' ORDER BY run_timestamp DESC Limit 1";


echo $queryWord;

$queryInventoryParsing = beerTrackDBQuery($queryWord);

echo ' hi!!!';

while($row = mysqli_fetch_array($queryInventoryParsing)) 
{

echo ' in loop #1';

    $newStock = $row['stock_at_timestamp'] + $quantity_ordered;
    $packageType = $row['single_package_type'];
    $packageQuantity = $row['single_package_quantity'];
    $packageVolume = $row['single_package_volume'];

    //Update entry in Inventory parsing
    $updateInventoryParsing = "INSERT INTO inventory_parsing_trying_something (run_timestamp, brewery_id, beerstore_store_id, beerstore_beer_id, single_package_type, single_package_quantity, single_package_volume, stock_at_timestamp, can_bottle_desc) 
    VALUES ('$run_timestamp', '$breweryIDPassed', '$location', '$beerIDPassed', '$packageType', '$packageQuantity', '$packageVolume', '$newStock', '$inventory_package_option')";
    beerTrackDBQuery($updateInventoryParsing);
    echo ' success?';
}

$body = 'The inventory of beer #' . $beerIDPassed . ' at store #' . $location . ' has been updated.';
$subject = 'Beer #' . $beerIDPassed . ' Inventory Updated';

createNotification($breweryIDPassed, $subject, $body, '1');


?>