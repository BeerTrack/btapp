<?php

function checkCurrentLocation($navTitle)
{
    $completeURLBar = $_SERVER['REQUEST_URI'];
    if (strpos($completeURLBar,$navTitle) !== false)
    {
        echo 'active';
    }
}

?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info" style="padding-left:5px">
                <p>Hello, <?php echo $loggedInPersonName; ?> </p>

                <a href="#"><?php echo $loggedInBreweryName; ?> </a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php checkCurrentLocation('global/dashboard'); ?>">
                <a href="/app/global/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Reports & Dashboards</span>
                </a>
            </li>
            <li class="treeview <?php checkCurrentLocation('/report'); ?>">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Sales Reporting</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/app/report/sales-inventory/"><i class="fa fa-angle-double-right"></i> Sales Inventory</a></li>
                    <li><a href="/app/report/sales-history/"><i class="fa fa-angle-double-right"></i> Sales History</a></li>
                    <li><a href="/app/report/pos-entry/"><i class="fa fa-angle-double-right"></i> POS Entry</a></li>
                </ul>
            </li>
            <?php if($showingCourse === "MSCI436"){ ?>
                <li class="treeview <?php checkCurrentLocation('/decide'); ?>">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Production/Logistics</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/app/decide/sales-forcast/"><i class="fa fa-angle-double-right"></i> Sales Forecast</a></li>
                        <li><a href="/app/decide/shipment-planner/"><i class="fa fa-angle-double-right"></i> Shipment Planner</a></li>
                    </ul>
                </li>
            <?php } ?>

            <li class="treeview <?php checkCurrentLocation('manage'); checkCurrentLocation('details'); ?>">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Brewery Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/app/global/manage-stores/"><i class="fa fa-angle-double-right"></i> Manage Stores</a></li>
                    <li><a href="/app/global/manage-beers/"><i class="fa fa-angle-double-right"></i> Manage Beers</a></li>
                    <li><a href="/app/global/brewery-details/"><i class="fa fa-angle-double-right"></i> Brewery Details</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>