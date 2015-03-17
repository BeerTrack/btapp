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
switch ($viewName) {
    case "viewQuery":
        $viewDisplayName = 'Sales History';
        $viewPageName = '_viewHistory.php';
        break;
    default: //setting the new query form / lookup form to be the default thing the users see
        $viewDisplayName = 'Sales History';
        $viewPageName = '_lookupStart.php';
        break;
}


// specific actions for some pages
switch ($requestedAction) {
    case "getHistoricalSales": //called when edit page is posted back
        // christiansThing();
        //Grabbing submitted text from form date range selection
        $inventory_beerstore_id = mysqli_real_escape_string(returnConnection(), $_POST['inventory_beerstore_id']);
        $inventory_location = mysqli_real_escape_string(returnConnection(), $_POST['inventory_location']);
        $timespanForInventoryLookup = mysqli_real_escape_string(returnConnection(), $_POST['timespanForInventoryLookup']);
        $inventory_package_type = mysqli_real_escape_string(returnConnection(), $_POST['inventory_package_type']);
        $inventory_package_single_volume = mysqli_real_escape_string(returnConnection(), $_POST['inventory_package_single_volume']);
        $inventory_package_quanity = mysqli_real_escape_string(returnConnection(), $_POST['inventory_package_quanity']);
        
        break;
}


//END: Homemade controller

//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function queryDatabaseForInventoryInfo() //to be used with viewQuery -> takes in the details from the lookup page
{
    # code...
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
        <?php 
        include $viewPageName; 
        if($requestedAction === "getHistoricalSales")
        {
            include '_viewAllHistory.php';
        }
        ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>