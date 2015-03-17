<?php

//setting the timezone
date_default_timezone_set("America/Toronto");

//see https://github.com/BeerTrack/btapp#getdateandstocklevels
function getDateAndStockLevels($startDate, $endDate, $beerstore_beer_ID, $beerstore_store_ID, $single_package_type, $single_package_quantity, $single_package_volume)
{
    $datesAndInventoryLevels = array();

    $selectStatement = "SELECT run_timestamp, stock_at_timestamp FROM inventory_parsing
    WHERE 
    run_timestamp >= '$startDate' AND 
    run_timestamp <= '$endDate' AND 
    beerstore_beer_ID = '$beerstore_beer_ID' AND
    beerstore_store_ID = '$beerstore_store_ID' AND
    single_package_type = '$single_package_type' AND
    single_package_quantity = '$single_package_quantity' AND 
    single_package_volume = '$single_package_volume'
    ORDER BY run_timestamp";

    $responseDataFromDB = beerTrackDBQuery($selectStatement);

    //putting the data into reaccesbile array
    $arrayCountMaker = 0;
    while($rowInventory = mysqli_fetch_array($responseDataFromDB)) {
        $datesAndInventoryLevels[$arrayCountMaker] = array($rowInventory['run_timestamp'], $rowInventory['stock_at_timestamp']) ;
        $arrayCountMaker++;
    }
    return $datesAndInventoryLevels;
}

function queryDatabaseForLatestInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity)
{
    $dateRange = explode(" - ", $timespanForInventoryLookup);
    //Makes an array with the start, current, and end dates
    $dateRange = array(Date($dateRange[0]),date("m/d/Y"),Date($dateRange[1]));
    $startDate = date_format((date_create($dateRange[0])),"Y-m-d");
    $endDate = date_format((date_create($dateRange[2])),"Y-m-d");

    $inventorySQLQuery = "SELECT * FROM inventory_parsing
    WHERE 
    run_timestamp >= '$startDate' AND 
    run_timestamp <= '$endDate' AND 
    beerstore_beer_ID = '$inventory_beerstore_id' AND
    beerstore_store_ID = '$inventory_location'";

    if($inventory_package_type != 'all')
    {
        $inventorySQLQuery .= " AND single_package_type = '$inventory_package_type'";
    }
    if($inventory_package_single_volume != 'all')
    {
        $inventorySQLQuery .= " AND single_package_volume = '$inventory_package_single_volume'";
    }
    if($inventory_package_quanity != 'all')
    {
        $inventorySQLQuery .= " AND single_package_quantity = '$inventory_package_quanity'";
    }

    $inventorySQLQuery .= " ORDER BY run_timestamp";

    // echo $inventorySQLQuery;

    $responseDataFromDB = beerTrackDBQuery($inventorySQLQuery);

    // print_r($responseDataFromDB);

    return $responseDataFromDB;
}


?>