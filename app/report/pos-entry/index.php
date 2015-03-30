<?php
//Include the files needed for functions on page such as auth and database connection
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
    default:
        $viewDisplayName = 'BeerTrack Point Of Sale - New Sale';
        $viewPageName = '_addPOSEntry.php';
        break;
}

//specific actions for some pages
switch ($requestedAction) {
    case "newOrder": //called when a new order is put through
        addPOSEntry();
        break;
}
//END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************

// Get the variables from the form and add the point of sale transaction to the database
function addPOSEntry()
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();
    $beer_name = mysqli_real_escape_string(returnConnection(), $_POST['beer_name']);
    $inventory_package_option = mysqli_real_escape_string(returnConnection(), $_POST['inventory_package_option']);
    $quantity_purchased = mysqli_real_escape_string(returnConnection(), $_POST['quantity_purchased']);
    $unit_price = mysqli_real_escape_string(returnConnection(), $_POST['unit_price']);
    $location =  mysqli_real_escape_string(returnConnection(), $_POST['inventory_location']);
    $run_timestamp = date('Y-m-d H:i:s', (time()));

    //Get latest entry in Inventory parsing table 
    $queryWord = "SELECT * FROM inventory_parsing WHERE beerstore_beer_id = '$beer_name' and beerstore_store_id = '$location' and can_bottle_desc = '$inventory_package_option' ORDER BY run_timestamp DESC Limit 1";
    $queryInventoryParsing = beerTrackDBQuery($queryWord);
    while($row = mysqli_fetch_array($queryInventoryParsing)) 
    {
        $newStock = $row['stock_at_timestamp'] - $quantity_purchased;
        $packageType = $row['single_package_type'];
        $packageQuantity = $row['single_package_quantity'];
        $packageVolume = $row['single_package_volume'];

        //Update entry in Inventory parsing
        $updateInventoryParsing = "INSERT INTO inventory_parsing (run_timestamp, brewery_id, beerstore_store_id, beerstore_beer_id, single_package_type, single_package_quantity, single_package_volume, stock_at_timestamp, can_bottle_desc) 
        VALUES ('$run_timestamp', '$functionLoggedInBreweryID', '$location', '$beer_name', '$packageType', '$packageQuantity', '$packageVolume', '$newStock', '$inventory_package_option')";
        beerTrackDBQuery($updateInventoryParsing);
    }
}
//END: Homemade models

?>

<?php
// Include the header and the nav bar
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
        
    <?php include $viewPageName; 
        if($requestedAction === "newOrder")
        {
            include '_calculations.php';
        }
    ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
//Include the footer
include '../../_shared/_footer.php';
?>