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
    default:
        $viewDisplayName = 'Brewery Settings';
        $viewPageName = '_updateDetails.php';
        break;
}

//specific actions for some pages
switch ($requestedAction) {
    case "sumbitUpdates": //called when a new order is put through
        editBrewery();
        break;
}
//END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function editBrewery();
{
    $breweryName = mysqli_real_escape_string(returnConnection(), $_POST['breweryName']);
    $breweryAddress = mysqli_real_escape_string(returnConnection(), $_POST['breweryAddress']);
    
    //Upadating beer info in the database
    $update_brewery_statement = "UPDATE breweries SET brewery_name = '$breweryName', brewery_address = '$breweryAddress' WHERE brewery_id = '$functionLoggedInBreweryID'";
    beerTrackDBQuery($update_brewery_statement); //beerTrackDBQuery is a function that takes in an SQL statement and returns the result of it

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
        
    <?php include $viewPageName; ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>