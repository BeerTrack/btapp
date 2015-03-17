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


function calcSalesThatDay($beerstore_beer_ID, $beerstore_store_ID, $presentDay, $beerstore_product_desc, $presentDayStock)
{
    // echo ' hi';
    $calcDaySalesQuery = "SELECT stock_at_timestamp FROM inventory_parsing WHERE
    run_timestamp > '$presentDay' AND
    can_bottle_desc = '$beerstore_product_desc' AND
    beerstore_beer_ID = '$beerstore_beer_ID' AND
    beerstore_store_ID = '$beerstore_store_ID'
    ORDER BY run_timestamp
    LIMIT 1";

// echo $calcDaySalesQuery;

    $reponseWithArray = beerTrackDBQuery($calcDaySalesQuery);
    $salesPresentDayPlus1 = mysqli_fetch_array($reponseWithArray)[0];

    return $presentDayStock - $salesPresentDayPlus1;

    // echo 'calcSalesThatDay: ' . $reponseWithArray;
}



function queryDatabaseForLatestInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity)
{
    $dateRange = explode(" - ", $timespanForInventoryLookup);
    //Makes an array with the start, current, and end dates
    $dateRange = array(Date($dateRange[0]),date("m/d/Y"),Date($dateRange[1]));
    $startDate = date_format((date_create($dateRange[0])),"Y-m-d");
    $endDate = date_format((date_create($dateRange[2])),"Y-m-d");

    $inventorySQLQuery = "SELECT * FROM inventory_parsing ip, beer_brands bb, stores ss
    WHERE 
    ip.beerstore_store_id = ss.beerstore_store_id AND
    ip.beerstore_beer_id = bb.beerstore_beer_id AND 
    ip.run_timestamp >= '$startDate' AND 
    ip.run_timestamp <= '$endDate' ";
    if($inventory_beerstore_id != 'all')
    {
        $inventorySQLQuery .= " AND ip.beerstore_beer_ID = '$inventory_beerstore_id'";
    }
    if($inventory_location != 'all')
    {
        $inventorySQLQuery .= " AND ip.beerstore_store_ID = '$inventory_location'";
    }
    if($inventory_package_type != 'all')
    {
        $inventorySQLQuery .= " AND ip.single_package_type = '$inventory_package_type'";
    }
    if($inventory_package_single_volume != 'all')
    {
        $inventorySQLQuery .= " AND ip.single_package_volume = '$inventory_package_single_volume'";
    }
    if($inventory_package_quanity != 'all')
    {
        $inventorySQLQuery .= " AND ip.single_package_quantity = '$inventory_package_quanity'";
    }

    $inventorySQLQuery .= " ORDER BY ip.run_timestamp";

    // echo $inventorySQLQuery;

    $responseDataFromDB = beerTrackDBQuery($inventorySQLQuery);

    // print_r($responseDataFromDB);

    return $responseDataFromDB;
}


?>