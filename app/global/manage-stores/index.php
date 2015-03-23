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
$viewDisplayName = 'Manage Stores'; //hard coding this because of layout change
switch ($viewName) {
    case "add":
        // $viewDisplayName = 'Manage Stores - Add Store';
        $viewPageName = '_addStore.php';
        break;
    case "edit":
        // $viewDisplayName = 'Manage Stores - Edit Store';
        $viewPageName = '_editStore.php';
        break;
    case "single":
        // $viewDisplayName = 'Manage Stores - Single Store';
        $viewPageName = '_singleStore.php';
        break;
    default:
        $viewPageName = '_viewAllStores.php';
        break;
}

//specific actions for some pages
switch ($requestedAction) {
    case "submitUpdates": //called when edit page is posted back
        editStoreProcess();
        break;
    case "add":
        addStoreProcess($loggedInBreweryID);
        break;
}
//END: Homemade controller

//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function addStoreProcess($loggedInBreweryID)
{

//Posting variables and escaping for security
$locationName = mysqli_real_escape_string(returnConnection(), $_POST['locationName']);
$locationAddress = mysqli_real_escape_string(returnConnection(), $_POST['locationAddress']);
$beerstoreStoreId = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerstoreStoreId']));

//Inserting store information into database
$insert_store="INSERT INTO stores (location_name, location_address, brewery_id, beerstore_store_id)
VALUES ('$locationName', '$locationAddress', '$loggedInBreweryID', '$beerstoreStoreId')";
beerTrackDBQuery($insert_store);

createNotification($loggedInBreweryID, "New Store Added", "$locationName has been added to your inventory of stores", "1");

}

function editStoreProcess()
{

//Posting variables and escaping for security
$locationName = mysqli_real_escape_string(returnConnection(), $_POST['locationName']);
$locationAddress = mysqli_real_escape_string(returnConnection(), $_POST['locationAddress']);
$beerstoreStoreId = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerstoreStoreId']));
$storeId = floatval(mysqli_real_escape_string(returnConnection(), $_POST['storeId']));


//Upadating store info in the database
    $update_store_statement = "UPDATE stores SET location_name = '$locationName', location_address = '$locationAddress', beerstore_store_id = '$beerstoreStoreId' WHERE store_Id = '$storeId'";
    beerTrackDBQuery($update_store_statement); //beerTrackDBQuery is a function that takes in an SQL statement and returns the result of it
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
    <section class="content-header shared-nav">
        <h1>
            <?php echo $viewDisplayName; ?>
        </h1>
        <div class="btn-group shared-nav-btn-group">
            <a href="?viewName=add" type="button" class="btn btn-primary">Add Store</a>
            <a href="?viewName=all" type="button" class="btn btn-primary">View All Stores</a>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        
        
    <?php
        include $viewPageName;
    ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>