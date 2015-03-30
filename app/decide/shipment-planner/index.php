<?php
include '../../_shared/_auth.php';
include '../../_shared/_databaseConnection.php';
include '../../_shared/_globalFunctions.php';

//**************************************************************
//START: Homemade Controller (to determine which view to show)
//**************************************************************
$viewName = $_GET['viewName'];
$requestedAction = $_GET['requestedAction'];

//which view to show
switch ($viewName) {
    default:
        $viewPageName = '_makePlan.php';
        break;
}
//END: Homemade controller
?>

<?php
include '../../_shared/_header.php';
include '../../_shared/_leftNav.php';
?>

<aside class="right-side">
    <section class="content-header">
        <h1>Shipment Planner</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        
    <?php include $viewPageName; ?>
    
    </section>
</aside>

<?php
include '../../_shared/_footer.php';
?>