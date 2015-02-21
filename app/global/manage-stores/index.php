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
    case "add":
        $viewDisplayName = 'Manage Beers - Add Beer';
        $viewPageName = '_addBeer.php';
        break;
    case "single":
        $viewDisplayName = 'Manage Beers - Beer Detail';
        $viewPageName = '_singleBeer.php';
        break;
    default:
        $viewDisplayName = 'Manage Beers - All Beers';
        $viewPageName = '_viewAllBeer.php';
        break;
}

//specific actions for some pages
switch ($requestedAction) {
    case "submitUpdates": //called when edit page is posted back
        editBeerProcess();
        break;
}
//END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function addStoreProcess()
{
    # code...
}

function deleteStore()
{
    # code...
}

function viewStores()
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
        <h1>
            <?php echo $viewDisplayName; ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
<!--         <div class="btn-group">
            <a href="?viewName=add" type="button" class="btn btn-default">Add Beer</a>
            <a href="?requestedAction=edit" type="button" class="btn btn-default">Middle</a>
            <a href="?requestedAction=" type="button" class="btn btn-default">Right</a>
        </div> -->
        
    <?php
        include $viewPageName;
    ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>