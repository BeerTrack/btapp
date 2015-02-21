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
            <div class="pull-left image">
                <img src="../../../assets/img/avatar3.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, Jane</p>

                <a href="#">Brewery Name</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php checkCurrentLocation('global/dashboard'); ?>">
                <a href="/app/global/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboards</span>
                </a>
            </li>
            <li class="treeview <?php checkCurrentLocation('/report'); ?>">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Report Cloud (444)</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/app/report/sales-inventory/"><i class="fa fa-angle-double-right"></i> Sales Inventory</a></li>
                    <li><a href="/app/report/sales-history/"><i class="fa fa-angle-double-right"></i> Sales History</a></li>
                    <li><a href="/app/report/pos-entry/"><i class="fa fa-angle-double-right"></i> POS Entry</a></li>
                </ul>
            </li>
            <li class="treeview <?php checkCurrentLocation('/decide'); ?>">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Decide Cloud (436)</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/app/decide/sales-forcast/"><i class="fa fa-angle-double-right"></i> Sales Forcast</a></li>
                    <li><a href="/app/decide/shipment-planner/"><i class="fa fa-angle-double-right"></i> Shipment Planner</a></li>
                </ul>
            </li>
            <li class="treeview <?php checkCurrentLocation('manage'); checkCurrentLocation('details'); ?>">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Settings</span>
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