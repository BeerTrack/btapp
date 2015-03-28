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
// END: Homemade controller

 
//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************

// specific actions for some pages
switch ($requestedAction) {
    case "forecast": 
        //Grabbing submitted text from form date range selection (in the format displayed to the user)
        $timespan_forecast_data_source_dates = mysqli_real_escape_string(returnConnection(), $_POST['timespan_forecast_data_source_dates']);
        $timespan_forecast_for = mysqli_real_escape_string(returnConnection(), $_POST['timespan_forecast_for']);

        //getting parts of the timestamps, to match what we need for the single forecast funciton.
        $start_timespan_forecast_data_source = substr($timespan_forecast_data_source_dates, 0, 10);
        $start_timespan_forecast_for = substr($timespan_forecast_for, 0, 10);
        $end_timespan_forecast_for = substr($timespan_forecast_for, 13, 10);

        //Posting beer ID from form...
        $selected_beerstore_beer_id = (mysqli_real_escape_string(returnConnection(), $_POST['selected_beerstore_beer_id']));
       
       break;
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