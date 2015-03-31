<!-- Functions that are used through out the website, called from many other pages. -->
<?php

//setting the timezone for all pages
date_default_timezone_set("America/Toronto");

//Creates a notification and adds it to the notifications table in the database.
function createNotification($brewery_id, $subject, $body, $status)
{
    $notificationQuery = "INSERT INTO notifications (brewery_id, subject, body, status)
    VALUES ('$brewery_id', '$subject', '$body', '$status')";
    beerTrackDBQuery($notificationQuery); 
}

//Edits the notification and changes the status to 0, thus dismissing it from the notifications page.
function editNotfication($notificationId)
{
    $notification1Query = ("UPDATE notifications SET status = '0' WHERE id = $notificationId");
    beerTrackDBQuery($notification1Query);
}

//Calculates the Sales 
function getDateAndStockLevels_CalculateSales($beerstore_beer_ID, $beerstore_store_ID, $single_package_type, $single_package_quantity, $single_package_volume, $presentDay, $presentDayStock)
{
    $calcDaySalesQuery = "SELECT stock_at_timestamp FROM inventory_parsing WHERE
    run_timestamp > '$presentDay' AND
    beerstore_beer_ID = '$beerstore_beer_ID' AND
    beerstore_store_ID = '$beerstore_store_ID' AND
    single_package_type = '$single_package_type' AND
    single_package_quantity = '$single_package_quantity' AND 
    single_package_volume = '$single_package_volume'
    ORDER BY run_timestamp
    LIMIT 1";

    $reponseWithArray = beerTrackDBQuery($calcDaySalesQuery);
    $salesPresentDayPlus1 = mysqli_fetch_array($reponseWithArray)[0];

    return $presentDayStock - $salesPresentDayPlus1;
}

//see https://github.com/BeerTrack/btapp#getdateandstocklevels
function getDateAndStockLevels($startDate, $endDate, $beerstore_beer_ID, $beerstore_store_ID, $single_package_type, $single_package_quantity, $single_package_volume)
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();

    $datesAndInventoryLevels = array();

    $selectStatement = "SELECT run_timestamp, stock_at_timestamp FROM inventory_parsing
    WHERE 
    run_timestamp >= '$startDate' AND 
    run_timestamp <= '$endDate' AND 
    beerstore_beer_ID = '$beerstore_beer_ID' AND
    beerstore_store_ID = '$beerstore_store_ID' AND
    single_package_type = '$single_package_type' AND
    single_package_quantity = '$single_package_quantity' AND 
    single_package_volume = '$single_package_volume' AND
    brewery_id = '$functionLoggedInBreweryID'
    ORDER BY run_timestamp";

    $responseDataFromDB = beerTrackDBQuery($selectStatement);

    //putting the data into reaccesbile array
    $arrayCountMaker = 0;
    while($rowInventory = mysqli_fetch_array($responseDataFromDB)) {
        $salesValueNotInventory = getDateAndStockLevels_CalculateSales($beerstore_beer_ID, $beerstore_store_ID, $single_package_type, $single_package_quantity, $single_package_volume, $rowInventory['run_timestamp'], $rowInventory['stock_at_timestamp']);
        $datesAndInventoryLevels[$arrayCountMaker] = array($rowInventory['run_timestamp'], $salesValueNotInventory) ;
        $arrayCountMaker++;
    }
    return $datesAndInventoryLevels;
}

//Calculates the sales of the day, number of beers sold
function calcSalesThatDay($beerstore_beer_ID, $beerstore_store_ID, $presentDay, $beerstore_product_desc, $presentDayStock)
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();
    $calcDaySalesQuery = "SELECT stock_at_timestamp FROM inventory_parsing WHERE
    run_timestamp > '$presentDay' AND
    can_bottle_desc = '$beerstore_product_desc' AND
    beerstore_beer_ID = '$beerstore_beer_ID' AND
    beerstore_store_ID = '$beerstore_store_ID' AND
    brewery_id = '$functionLoggedInBreweryID'
    GROUP BY run_timestamp
    ORDER BY run_timestamp
    LIMIT 1";

    $reponseWithArray = beerTrackDBQuery($calcDaySalesQuery);
    $salesPresentDayPlus1 = mysqli_fetch_array($reponseWithArray)[0];

    return $presentDayStock - $salesPresentDayPlus1;
}


function queryDatabaseForSalesInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity)
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();

    //Parsing text date range into array
    $dateRange = explode("-", $timespanForInventoryLookup);

    $startDate = date_create($dateRange[0]);
    $endDate = date_create($dateRange[1]);

    $startDate = date_format($startDate,"Y-m-d");
    $endDate = date_format($endDate,"Y-m-d");

    $inventorySQLQuery = "SELECT DISTINCT ip.run_timestamp, ip.can_bottle_desc, ip.stock_at_timestamp, ip.single_package_type, ip.single_package_quantity, ip.single_package_volume, bb.beer_name, ss.location_name, ip.beerstore_store_id, ip.beerstore_beer_id ";
    $inventorySQLQuery .= "FROM inventory_parsing ip, beer_brands bb, stores ss 
    WHERE 
    ip.beerstore_store_id = ss.beerstore_store_id AND 
    ip.beerstore_beer_id = bb.beerstore_beer_id AND 
    ip.brewery_id = ss.brewery_id AND 
    ip.brewery_id = bb.brewery_id AND 
    ip.brewery_id = '$functionLoggedInBreweryID' AND 
    ip.run_timestamp >= '$startDate' AND 
    ip.run_timestamp <= '$endDate' ";

    // echo ' start of inventorySQLQuery' . $inventorySQLQuery;

    if($inventory_beerstore_id != 'all')
    {
        $inventorySQLQuery .= " AND ip.beerstore_beer_id = '$inventory_beerstore_id'";
    }
    if($inventory_location != 'all')
    {
        $inventorySQLQuery .= " AND ip.beerstore_store_id = '$inventory_location'";
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

    $inventorySQLQuery .= " GROUP BY ip.run_timestamp ORDER BY ip.run_timestamp";

    // echo $inventorySQLQuery;

    $responseDataFromDB = beerTrackDBQuery($inventorySQLQuery);

    // print_r($responseDataFromDB);

    return $responseDataFromDB;
}

function queryDatabaseForLatestInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity)
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();

    // echo 'loggedin brew: ' . $functionLoggedInBreweryID;

    $targetSalesDay = new DateTime($timespanForInventoryLookup);
    $targetSalesDay = date_format($targetSalesDay, 'Y-m-d');
    $dayAfterTarget = date('Y-m-d', strtotime($targetSalesDay . ' + 1 days'));

    $inventorySQLQuery = "SELECT DISTINCT ip.run_timestamp, ip.can_bottle_desc, ip.stock_at_timestamp, ip.single_package_type, ip.single_package_quantity, ip.single_package_volume, bb.beer_name, ss.location_name, ip.beerstore_store_id, ip.beerstore_beer_id ";
    $inventorySQLQuery .= "FROM inventory_parsing ip, beer_brands bb, stores ss 
    WHERE 
    ip.beerstore_store_id = ss.beerstore_store_id AND 
    ip.beerstore_beer_id = bb.beerstore_beer_id AND 
    ip.brewery_id = ss.brewery_id AND 
    ip.brewery_id = bb.brewery_id AND 
    ip.brewery_id = '$functionLoggedInBreweryID' AND 
    ip.run_timestamp LIKE '$targetSalesDay 00:00:00'";

    // echo ' start of inventorySQLQuery' . $inventorySQLQuery;

    if($inventory_beerstore_id != 'all')
    {
        $inventorySQLQuery .= " AND ip.beerstore_beer_id = '$inventory_beerstore_id'";
    }
    if($inventory_location != 'all')
    {
        $inventorySQLQuery .= " AND ip.beerstore_store_id = '$inventory_location'";
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

    $inventorySQLQuery .= " GROUP BY ip.run_timestamp ORDER BY ip.run_timestamp";

    // echo $inventorySQLQuery;
    // echo ' hi!';

    $responseDataFromDB = beerTrackDBQuery($inventorySQLQuery);

    // print_r($responseDataFromDB);

    return $responseDataFromDB;
}

function basicForcast($pointsPassed)
{
    $parameters = array(0, 0);
    $last_parameters = false;
    do {
        $last_parameters = $parameters;
        $parameters = gradient($pointsPassed, $parameters);
    } while($parameters != false);
    return  ($last_parameters);
}

function singleDayForecastGen($textDateRangePassed, $beerID, $storeID, $container, $quantity, $volume)
{
    //Parsing text date range into array
    $dateRange = explode(" - ", $textDateRangePassed);
    //Makes an array with the start-0, current-1, and end-2 dates
    $dateRange = array(Date($dateRange[0]),date("m/d/Y"),Date($dateRange[1]));
    //Determines number of days ahead the forecast is to be made for
    $daysAhead = ceil(abs((strtotime($dateRange[2]) - strtotime($dateRange[1])) / 86400));
    //Creates and stores start and end dates as date objects
    $startDate = date_create($dateRange[0]);
    $endDate = date_create($dateRange[2]);

    //Fetches stock levels array from start to end date for a specific beer and store and stores it
    $stockLevels = getDateAndStockLevels(date_format($startDate,"Y-m-d"), date_format($endDate,"Y-m-d"), $beerID, $storeID, $container, $quantity, $volume);

    if(count($stockLevels) < 2)
    {
        return "nodata";
    }

    //Changes date values in $stockLevels to 1, 2, 3, ... so that the large date numbers can be squared and stored in vars for forecast processing
    $count = 1;
    foreach ($stockLevels as &$row) {
        $row[0] = $count;
        // echo "(" . $stockLevels[$count - 1][0] . ", " . $stockLevels[$count - 1][1] . ")";
        $count = $count + 1;
    };

    //*****------------------*****
    //*****Forecast Generator*****
    //*****------------------*****

    //Linear regression forecast
    $slopeAndY = basicForcast($stockLevels);
    $LRforecast = ((floatval($slopeAndY[1]) * (count($stockLevels) + $daysAhead)) + floatval($slopeAndY[0]));
    
    //Moving average forecast
    $sum = 0;

    foreach ($stockLevels as list($date, $sales)) 
    {
        $sum = $sum + $sales;
    };

    $MAforecast = $sum / count($stockLevels);
    //Output total forecast based 80% on the MA forecast and 20% on the LR forecast
    $mainForecast = (0.8 * floatval($MAforecast) + 0.2 * floatval($LRforecast));
     
    return $mainForecast;
}


// Function for getting inventory summed across mutliple stores (not filtered by store ID...)
function queryDatabaseForInventoryNoStoreFilter($singleDateChecking)
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();
    $targetSalesDay = new DateTime($singleDateChecking);
    $targetSalesDay = date_format($targetSalesDay, 'Y-m-d');
    $dayAfterTarget = date('Y-m-d', strtotime($targetSalesDay . ' + 1 days'));

    $inventorySQLQuery = "SELECT ip.run_timestamp, bb.beer_name, bb.beerstore_beer_id, ip.single_package_type, ip.single_package_volume, ip.single_package_quantity, ip.can_bottle_desc, sum(ip.stock_at_timestamp) 
    FROM inventory_parsing ip, beer_brands bb
    WHERE 
    bb.beerstore_beer_id = ip.beerstore_beer_id AND 
    ip.run_timestamp >= '$targetSalesDay' AND 
    ip.run_timestamp <= '$dayAfterTarget' AND
    ip.brewery_id = '$functionLoggedInBreweryID'
    GROUP BY
    ip.beerstore_beer_id, ip.can_bottle_desc";

    $responseDataFromDB = beerTrackDBQuery($inventorySQLQuery);

    return $responseDataFromDB;
}

function calcSalesThatDayNoStoreFilter($beerstore_beer_ID, $presentDay, $beerstore_product_desc, $presentDayStock)
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();
    
    $calcDaySalesQuery = "SELECT sum(stock_at_timestamp) 
    FROM inventory_parsing
    WHERE 
    run_timestamp > '$presentDay' AND
    can_bottle_desc = '$beerstore_product_desc' AND
    beerstore_beer_ID = '$beerstore_beer_ID' AND
    brewery_id = '$functionLoggedInBreweryID' 
    ORDER BY run_timestamp
    LIMIT 1";

    $reponseWithArray = beerTrackDBQuery($calcDaySalesQuery);
    $salesPresentDayPlus1 = mysqli_fetch_array($reponseWithArray)[0];

    return abs($presentDayStock - $salesPresentDayPlus1);
}

function queryDatabaseForInventoryStoreFilter($singleDateChecking, $storeToFilter)
{
    // echo $storeToFilter;
    $functionLoggedInBreweryID = returnLoggedInBreweryID();
    $targetSalesDay = new DateTime($singleDateChecking);
    $targetSalesDay = date_format($targetSalesDay, 'Y-m-d');
    $dayAfterTarget = date('Y-m-d', strtotime($targetSalesDay . ' + 1 days'));

    $inventorySQLQuery = "SELECT ip.run_timestamp, bb.beer_name, bb.beerstore_beer_id, ip.single_package_type, ip.single_package_volume, ip.single_package_quantity, ip.can_bottle_desc, sum(ip.stock_at_timestamp) 
    FROM inventory_parsing ip, beer_brands bb 
    WHERE ";

    if($storeToFilter == 'all')
    {
    }
    else
    {
        $inventorySQLQuery .= " ip.beerstore_store_id = '$storeToFilter' AND ";
    }

    $inventorySQLQuery .= "
    bb.beerstore_beer_id = ip.beerstore_beer_id AND 
    ip.run_timestamp >= '$targetSalesDay' AND 
    ip.run_timestamp <= '$dayAfterTarget' AND
    ip.brewery_id = '$functionLoggedInBreweryID'
    GROUP BY
    ip.beerstore_beer_id, ip.can_bottle_desc";

    $responseDataFromDB = beerTrackDBQuery($inventorySQLQuery);

    return $responseDataFromDB;
}



?>