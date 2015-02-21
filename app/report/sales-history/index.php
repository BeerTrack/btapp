<?php
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
    case "viewQuery":
        $viewDisplayName = 'Sales History - Lookup Results';
        $viewPageName = '_viewHistory.php';
        break;
    default: //setting the new query form / lookup form to be the default thing the users see
        $viewDisplayName = 'Sales History - Lookup';
        $viewPageName = '_lookupStart.php';
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
        <?php include $viewPageName; ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>