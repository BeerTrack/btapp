<?php
include '../../_shared/_databaseConnection.php';
include '_ianbarber_lin_reg.php';

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

// specific actions for some pages
switch ($requestedAction) {
    case "forecast": //called when edit page is posted back
        addDateRange();
        break;
}
// END: Homemade controller


//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************
function basicForcast($pointsPassed)
{
    $parameters = array(0, 0);
    $last_parameters = false;
    do {
        $last_parameters = $parameters;
        $parameters = gradient($pointsPassed, $parameters);
    } while($parameters != false);
    return  ($last_parameters);
}

function addDateRange()
{
    //Posting variables and escaping for security
    $textDateRange = mysql_escape_string($_POST['reservation']);
    echo $textDateRange;
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