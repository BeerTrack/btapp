<?php
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
function addPOSEntry()
{
    $beer_name = mysqli_real_escape_string(returnConnection(), $_POST['beer_name']);
    $package_type = mysqli_real_escape_string(returnConnection(), $_POST['package_type']);
    $package_quantity = mysqli_real_escape_string(returnConnection(), $_POST['package_quantity']);
echo $beer_name;
echo $package_type;
echo $package_quantity;
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
        
    <?php include $viewPageName; 
        if($requestedAction === "newOrder")
        {
            include '_calculations.php';
        }
    ?>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php
include '../../_shared/_footer.php';
?>