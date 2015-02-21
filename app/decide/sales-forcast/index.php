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
    // case "add":
    //     $viewDisplayName = 'Manage Beers - Add Beer';
    //     $viewPageName = '_addBeer.php';
    //     break;
    default:
        $viewDisplayName = 'Sales Forcasts - Overview';
        $viewPageName = '_forcastsHome.php';
        break;
}

//specific actions for some pages
// switch ($requestedAction) {
//     case "submitUpdates": //called when edit page is posted back
//         editBeerProcess();
//         break;
// }
//END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
$arrayOfPastDays = ''; // See here: http://www.w3schools.com/php/func_array.asp
$arrayOfPastSalesOrInventoryLevels = ''; //see the same link above, arguably you could conbine these into a multi dimensional array. 

function basicForcast($pastDays, $pastSales, $numDaysAhead) //numDaysAhead is the number of days from the latest day you have sales data on. For example, if you have data on Monday and Tuesday, and want to know how much you're going to sell on Friday, this value is "3".
{
    echo ' test called basicForcast';
}


//END: Homemade models

include '../../_shared/_header.php';
include '../../_shared/_leftNav.php';
?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $viewDisplayName; ?></h1>
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