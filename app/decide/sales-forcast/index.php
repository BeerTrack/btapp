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
        $textDateRange = mysql_escape_string($_POST['reservation']);
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
    // YO CHRISTIAN: I MOVED THIS TO THE HEADER, BC I NEEDED IT TOO... - PHIL //date_default_timezone_set("America/Toronto");
    //Parsing text date range into array
    $dateRange = explode(" - ", $textDateRangePassed);
    //Makes an array with the start, current, and end dates
    $dateRange = array(Date($dateRange[0]),date("m/d/Y"),Date($dateRange[1]));


    // $dateRange = addDateRange($userEnteredStartToEndDate);
// echo "</br>" . "start date is: " . $dateRange[0];
// echo "</br>" . "current date is: " .  $dateRange[1];
// echo "</br>" . "end date is: " . $dateRange[2];
//Determines number of days ahead the forecast is to be made for
$daysAhead = ceil(abs((strtotime($dateRange[2]) - strtotime($dateRange[1])) / 86400));
// echo "</br>" . "num days ahead is: " . $daysAhead . "</br>";

//Note: changed "$dataOfPhilAndChristian" to $stockLevels
// $dataOfPhilAndChristian = array(
// array("a", 100),
// array("hose", 96),
// array(31, 98),
// array(41, 103),
// array(51, 100),
// array(61, 103),
// array(71, 109),
// array(81, 106),
// array(91, 105),
// array(101, 106),
// array(111, 109),
// array(121, 117),
// array(131, 113),
// array(141, 113)
// );

$startDate = date_create($dateRange[0]);
// print_r($startDate);
$endDate = date_create($dateRange[2]);
$stockLevels = getDateAndStockLevels(date_format($startDate,"Y-m-d"), date_format($endDate,"Y-m-d"), '3211', '2322', 'Bottle', '12', '341');
// echo "</br>";
// print_r($stockLevels);
// echo "</br>";

//Converts array passed in from database
// echo "Converted data array: ";
$count = 1;
foreach ($stockLevels as &$row) {
    $row[0] = $count;
    // echo "(" . $stockLevels[$count - 1][0] . ", " . $stockLevels[$count - 1][1] . ")";
    $count = $count + 1;
};

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