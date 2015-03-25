<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-xs-4">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    {{SUM SOLD YESTURDAY}}
                </h3>
                <p>
                    Beer Sold Yesturday
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-android-bar"></i>
            </div>
            <a href="/app/report/sales-inventory/" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-xs-4">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    {{STORE_NAME}}
                </h3>
                <p>
                    Yesturday's Top Performing Store
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-android-list"></i>
            </div>
            <a href="/app/report/sales-inventory/" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-xs-4">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    {{BEERS SOLD PER DAY}}
                </h3>
                <p>
                    Beers Sold Per Day
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-pulse-strong"></i>
            </div>
            <a href="/app/report/sales-history/" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->


<!-- Main row -->
<div class="row">

<?php 
include '_wid-salesPerBeerNoStoreTable.php';
?>


<?php 
include '_wid-storeMap.php';
?>

<?php 
include '_wid-inventoryPerBeerGraph.php';
?>
    
<?php 
include '_wid-inventoryByBeerPieChart.php';
?>

<?php 
include '_wid-addPosEntry.php';
?>
    
</div>

