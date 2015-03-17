<?php
include '../../_shared/_auth.php';
include '../../_shared/_databaseConnection.php';
include '../../_shared/_globalFunctions.php';
include '_ianbarber_lin_reg.php';

//**************************************************************
//START: Homemade Controller (to determine which view to show)
//**************************************************************
$viewName = $_GET['viewName'];
$requestedAction = $_GET['requestedAction'];
$viewDisplayName = '';
$viewPageName = '';

//which view to show
switch ($viewName) {
    case "results":
        $viewDisplayName = 'Sales Forcasts - Results';
        $viewPageName = '_forcastResults.php';
        break;
    default:
        $viewDisplayName = 'Sales Forcasts - Overview';
        $viewPageName = '_forcastsHome.php';
        break;
}

// specific actions for some pages
switch ($requestedAction) {
    case "forecast": //called when edit page is posted back
        // christiansThing();
        //Grabbing submitted text from form date range selection
        $textDateRange = mysql_escape_string(returnConnection(), $_POST['reservation']);
        //*******dont work yet*********
        //Posting variables and escaping for security
        $beerID = floatval(mysql_escape_string(returnConnection(), $_POST['beerType']));
        $storeID = floatval(mysql_escape_string(returnConnection(), $_POST['store']));
        $container = mysql_escape_string(returnConnection(), $_POST['container']);
        $quantity = floatval(mysql_escape_string(returnConnection(), $_POST['quantity']));
        $volume = floatval(mysql_escape_string(returnConnection(), $_POST['volume']));
        echo $beerID;
        // //Takes in a SQL query and returns the result
        // beerTrackDBQuery($insert_store);
        break;

    case "getData": //called when edit page is posted back
        // $data = getSalesData('2015-03-02', '2015-03-08', '3211', '2322', 'Bottle', '24', '341');
        // $data = getDateAndStockLevels('2015-03-02', '2015-03-08', '3211', '2322', 'Bottle', '12', '341');
        $data = getDateAndStockLevels('2015-03-02', '2015-03-03', '3211', '2322', 'Bottle', '12', '341');

        echo 'Stock On March 2nd: ' . $data[0][1];
        break;
}
// END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
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

function christiansThing($textDateRangePassed)
{
    //Sets the time zone
    date_default_timezone_set("America/Toronto");
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
    print_r($stockLevels);
    echo "<br/>start date" . date_format($startDate,"Y-m-d");
    echo "<br/>end date" . date_format($endDate,"Y-m-d");
    echo "<br/>beerID" . $beerID;
    echo "<br/>store date" . $storeID;
    echo "<br/>container" . $container;
    echo "<br/>quantity" . $quantity;
    echo "<br/>volume" . $volume;

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
foreach ($stockLevels as list($date, $sales)) {
    $sum = $sum + $sales;
    };
$Aforecast = $sum / count($stockLevels);
//Output total forecast based 80% on the MA forecast and 20% on the LR forecast
// echo "</br> Predicted number of sales for " . $dateRange[2] . " is: " . (0.8 * floatval($Aforecast) + 0.2 * floatval($LRforecast));
$golden = (0.8 * floatval($Aforecast) + 0.2 * floatval($LRforecast));
 

    return $golden;
}



//END: Homemade models

include '../../_shared/_header.php';
include '../../_shared/_leftNav.php';
?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $viewDisplayName; ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <?php
    if($viewPageName != '_forcastsHome.php')
    {
        include '_forcastsHome.php';   
    }
        include $viewPageName;
    ?>

    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>