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
        $textDateRange = mysqli_real_escape_string(returnConnection(), $_POST['reservation']);
        //*******dont work yet*********
        //Posting variables and escaping for security
        $beerID = (mysqli_real_escape_string(returnConnection(), $_POST['beerID']));
        $storeID = floatval(mysqli_real_escape_string(returnConnection(), $_POST['store']));
        $container = mysqli_real_escape_string(returnConnection(), $_POST['container']);
        $quantity = floatval(mysqli_real_escape_string(returnConnection(), $_POST['quantity']));
        $volume = floatval(mysqli_real_escape_string(returnConnection(), $_POST['volume']));
        echo 'top beer ID:' . $beerID;
        echo 'top store:' . $storeID;
        echo 'top container:' . $container;
        echo '</br> top timespan: ' . $textDateRange;
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