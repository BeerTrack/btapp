<?php

function topPackage()
{
    $functionLoggedInBreweryID = returnLoggedInBreweryID();
    $todayTarget = date("Y-m-d");
    $dayBeforeTarget = date('Y-m-d', strtotime($todayTarget . ' - 1 days'));

    $topPackageQuery = "SELECT ip.run_timestamp, bb.beer_name, bb.beerstore_beer_id, ip.single_package_type, ip.single_package_volume, ip.single_package_quantity, ip.can_bottle_desc, sum(ip.stock_at_timestamp) 
    FROM inventory_parsing ip, beer_brands bb
    WHERE 
    bb.beerstore_beer_id = ip.beerstore_beer_id AND 
    ip.run_timestamp >= '$dayBeforeTarget' AND 
    ip.run_timestamp <= '$todayTarget' AND
    ip.brewery_id = '$functionLoggedInBreweryID'
    GROUP BY
    ip.beerstore_beer_id, ip.can_bottle_desc
    ORDER BY
    sum(ip.stock_at_timestamp) DESC
    LIMIT 1";

    $topPackage = beerTrackDBQuery($topPackageQuery);

    $topPackage = mysqli_fetch_array($topPackage);
    echo $topPackage['can_bottle_desc'];
}



function totalLiters()
{
    $storeForFilteringGraph = 'all';

    $dataPoints = array();
    $dataPointNames = array();
    $todaysDate = date("Y-m-d");

    $catcherToStopToManyNames = 0;

    $dateToRunWith = date('Y-m-d', strtotime($todaysDate));

    $runningTotal = 0;
    $listings = queryDatabaseForInventoryStoreFilter($dateToRunWith, $storeForFilteringGraph);

    while($row = mysqli_fetch_array($listings)) {
        $thisRecordML = $row[7] * $row['single_package_quantity'] * $row['single_package_volume'];
        $runningTotal = $thisRecordML + $runningTotal;
    }
    
    echo Round(($runningTotal / 1000),2);
}


?>


<!-- Small boxes (Stat box) -->
<div class="row">

    <div class="col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    <?php totalLiters(); ?> liters
                </h3>
                <p>
                    of beer stocked across all stores
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

    <div class="col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?php topPackage();?>
                </h3>
                <p>
                    most popular package (lifetime)
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


<script type="text/javascript">

$( document ).ready(function() {

    var totalSalesYesturday = 0;
    $(".calcSalesThatDayNoStoreFilter").each(function( index ) {
            var thisVal = parseInt($( this ).text());
            // console.log(thisVal);
            totalSalesYesturday = totalSalesYesturday + thisVal;
            $("#sumSoldYes").text(totalSalesYesturday + ' packages');
        });


});
</script>