<?php
include '../../_shared/_auth.php';
include '../../_shared/_databaseConnection.php';
include '../../_shared/_globalFunctions.php';

//**************************************************************
//START: Homemade Controller (to determine which view to show)
//**************************************************************
$viewName = $_GET['viewName'];
$requestedAction = $_GET['requestedAction'];
$viewDisplayName = '';
$viewPageName = '';

//which view to show
$viewDisplayName = 'Sales Inventory'; //hard coding

switch ($viewName) {
    default:
        $viewPageName = '_searchInventory.php';
        break;
}
//END: Homemade controller

//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function queryDatabaseForLatestInventory($textDateRangePassed)
{
    $dateRange = explode(" - ", $textDateRangePassed);
    //Makes an array with the start, current, and end dates
    $dateRange = array(Date($dateRange[0]),date("m/d/Y"),Date($dateRange[1]));

    $startDate = date_format((date_create($dateRange[0])),"Y-m-d");
    $endDate = date_format((date_create($dateRange[2])),"Y-m-d");
}
//END: Homemade models
?>

<?php
include '../../_shared/_header.php';
include '../../_shared/_leftNav.php';
?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo $viewDisplayName; ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php include $viewPageName; ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>