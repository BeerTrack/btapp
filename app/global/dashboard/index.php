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
    case "notifications":
        $viewDisplayName = 'Notifications';
        $viewPageName = '_notifications.php';
        break;
    default:
        if($showingCourse == 'MSCI444')
        {
            $viewDisplayName = 'Reports & Dashboards';
            $viewPageName = '_reportDashboard.php';
        }
        else if($showingCourse == 'MSCI436')
        {
            $viewDisplayName = 'Reports & Dashboards';
            $viewPageName = '_decideDashboard.php';
        }
        else
        {
            $viewDisplayName = 'Reports & Dashboards';
            $viewPageName = '_decideDashboard.php';
        }
        break;
}


//END: Homemade controller

//**************************************************************
//START: Homemade Models (for each of our controllers)
//**************************************************************

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
        <h1> <?php echo $viewDisplayName; ?> </h1>
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