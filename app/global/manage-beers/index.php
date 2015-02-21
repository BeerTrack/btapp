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
    case "edit":
        $viewDisplayName = 'Manage Beers - Edit Beer';
        $viewPageName = '_editBeer.php';
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
    case "add":
        addBeerProcess();
        break;
}
//END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function addBeerProcess()
{

//Posting variables and escaping for security
$beerSize = floatval(mysqli_real_escape_string($primaryBeerTrackDB, $_POST['beerSize']));
$beerName = mysqli_real_escape_string($primaryBeerTrackDB, $_POST['beerName']);
$beerType = mysqli_real_escape_string($primaryBeerTrackDB, $_POST['beerType']);
$beerPrice = floatval(mysqli_real_escape_string($primaryBeerTrackDB, $_POST['beerPrice']));
$beerQuantity = floatval(mysqli_real_escape_string($primaryBeerTrackDB, $_POST['beerQuantity']));

//Inserting beer information into database
$insert_beer="INSERT INTO beer_brands (beer_name, beer_price, beer_size, beer_type, beer_quantity)
VALUES ('$beerName', '$beerPrice', '$beerSize', '$beerType', '$beer_Quantity')";
mysqli_query($primaryBeerTrackDB, $insert_beer);

}

function editBeerAutoLoadValues() //function that provides the data to be used/referenced/auto loaded in the form on _editBeer.php
{
    # code...
}

function editBeerProcess() //function to update the beer table
{
    # code...
}

function viewAllBeer()
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