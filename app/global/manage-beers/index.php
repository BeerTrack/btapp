<?php
//Include the files needed for functions on page such as auth and database connection
include '../../_shared/_auth.php';
include '../../_shared/_databaseConnection.php';
include '../../_shared/_globalFunctions.php';

//**************************************************************
//START: Homemade Controller (to determine which view to show)
//**************************************************************
$viewName = $_GET['viewName'];
$requestedAction = $_GET['requestedAction'];
$viewPageName = '';

//which view to show
$viewDisplayName = 'Manage Beers'; //hard coding now that the boxes change with it...
switch ($viewName) {
    case "add":
        $viewPageName = '_addBeer.php';
        break;
    case "edit":
        $viewPageName = '_editBeer.php';
        break;
    case "single":
        $viewPageName = '_singleBeer.php';
        break;
    default:
        $viewPageName = '_viewAllBeer.php';
        break;
}

//specific actions for some pages
switch ($requestedAction) {
    case "submitUpdates": //called when edit page is posted back
        editBeerProcess();
        break;
    case "add":
        addBeerProcess($loggedInBreweryID);
        break;

}
//END: Homemade Controller

//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function addBeerProcess($loggedInBreweryID)
{
    //Posting variables and escaping for security
    $beerSize = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerSize']));
    $beerName = mysqli_real_escape_string(returnConnection(), $_POST['beerName']);
    $beerType = mysqli_real_escape_string(returnConnection(), $_POST['beerType']);
    $beerPrice = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerPrice']));
    $beerQuantity = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerQuantity']));
    $beerstoreBeerId = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerstoreBeerId']));

    //Inserting beer information into database
    $insert_beer_statement = "INSERT INTO beer_brands (beer_name, beer_price, beer_size, beer_type, beer_quantity, beerstore_beer_id, brewery_id)
    VALUES ('$beerName', '$beerPrice', '$beerSize', '$beerType', '$beerQuantity', '$beerstoreBeerId', '$loggedInBreweryID')";
    beerTrackDBQuery($insert_beer_statement); //beerTrackDBQuery is a function that takes in an SQL statement and returns the result of it

    createNotification($loggedInBreweryID, "New Beer Added", "$beerName has been added to your inventory of beers", "1");
}

function editBeerProcess() //function to update the beer table
{
    //Posting variables and escaping for security
    $beerSize = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerSize']));
    $beerName = mysqli_real_escape_string(returnConnection(), $_POST['beerName']);
    $beerType = mysqli_real_escape_string(returnConnection(), $_POST['beerType']);
    $beerPrice = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerPrice']));
    $beerQuantity = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerQuantity']));
    $beerstoreBeerId = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerstoreBeerId']));
    $beerId = floatval(mysqli_real_escape_string(returnConnection(), $_POST['beerId']));

    //Upadating beer info in the database
    $update_beer_statement = "UPDATE beer_brands SET beer_name = '$beerName', beer_price = '$beerPrice', beer_size = '$beerSize', beer_type = '$beerType', beer_quantity = '$beerQuantity', beerstore_beer_id = '$beerstoreBeerId' WHERE beer_id = '$beerId'";
    beerTrackDBQuery($update_beer_statement); //beerTrackDBQuery is a function that takes in an SQL statement and returns the result of it
}
//END: Homemade Models

?>

<?php
// Include the header and the nav bar
include '../../_shared/_header.php';
include '../../_shared/_leftNav.php';
?>

<aside class="right-side">
    <section class="content-header shared-nav">
        <h1>
            <?php echo $viewDisplayName; ?>
        </h1>
        <div class="btn-group shared-nav-btn-group">
            <a href="?viewName=add" type="button" class="btn btn-primary">Add Beer</a>
            <a href="?viewName=all" type="button" class="btn btn-primary">View All Beers</a>
        </div>
    </section>

    <section class="content">
    <?php include $viewPageName; ?>
    </section>
</aside>

<?php
//Include the footer
include '../../_shared/_footer.php';
?>