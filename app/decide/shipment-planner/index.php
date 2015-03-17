<?php
include '../../_shared/_auth.php';
include '../../_shared/_databaseConnection.php';

//**************************************************************
//START: Homemade Controller (to determine which view to show)
//**************************************************************
$viewName = $_GET['viewName'];
$requestedAction = $_GET['requestedAction'];
$viewDisplayName = '';
$viewPageName = '';

//which view to show
switch ($viewName) {
    case "initiate-edit":
        $viewPageName = '_initiateOrEditPlan.php';
        break;
    case "single":
        $viewPageName = '_singlePlan.php';
        break;
    default:
        $viewPageName = '_makePlan.php';
        break;
}

//specific actions for some pages
switch ($requestedAction) {
    case "submitUpdates": //called when edit page is posted back
        editBeerProcess();
        break;
    case "makePlan":
    recordNewOrUpdatedPlanInDB();
        break:
}
//END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function recordNewOrUpdatedPlanInDB()
{

$listLocations = array();

foreach ($_POST['locations'] as $locations)
{
    $listLocations[] = $locations;
}
}

//there's going to be alot of other functions in here, this is where the google API stuff will go, and if we need to call forcasting data, etc...

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
        <h1>
            Shipment Planner
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        
    <?php include $viewPageName; ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>