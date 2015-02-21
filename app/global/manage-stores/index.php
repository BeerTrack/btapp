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
        $viewDisplayName = 'Manage Stores - Add Store';
        $viewPageName = '_addStore.php';
        break;
    case "single":
        $viewDisplayName = 'Manage Stores - Single Store';
        $viewPageName = '_singleStore.php';
        break;
    default:
        $viewDisplayName = 'Manage Stores - All Stores';
        $viewPageName = '_viewAllStores.php';
        break;
}

//specific actions for some pages
switch ($requestedAction) {
    case "submitUpdates": //called when edit page is posted back
        editBeerProcess();
        break;
    case "add":
        addStoreProcess();
        break;
}
//END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function addStoreProcess()
{

//Posting variables and escaping for security
$locationName = mysqli_real_escape_string($primaryBeerTrackDB, $_POST['beerSize']);
$locationAddress = mysqli_real_escape_string($primaryBeerTrackDB, $_POST['beerName']);

//Inserting store information into database
$insert_store="INSERT INTO stores (location_name, location_address, brewery_id)
VALUES ('$locationName', '$locationAddress', "1")";
mysqli_query($primaryBeerTrackDB, $insert_store);

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