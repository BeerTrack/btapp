<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    150
                </h3>
                <p>
                    New Orders
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    53<sup style="font-size: 20px">%</sup>
                </h3>
                <p>
                    Bounce Rate
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    44
                </h3>
                <p>
                    User Registrations
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    65
                </h3>
                <p>
                    Unique Visitors
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div><!-- /.row -->


<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
        </div><!-- /.nav-tabs-custom -->
    </section>
    <!-- </div> -->


<?php 
include '_wid-storeMap.php';
?>
    
</div>


<script type="text/javascript">

// $('#canadaMap').vectorMap({
//     map: 'world_mill_en',
//     backgroundColor: "transparent"
// });


//  var visitorsData = {
//         "US": 398, //USA
//         "SA": 400, //Saudi Arabia
//         "CA": 0, //Canada
//         "DE": 500, //Germany
//         "FR": 760, //France
//         "CN": 300, //China
//         "AU": 700, //Australia
//         "BR": 600, //Brazil
//         "IN": 800, //India
//         "GB": 320, //Great Britain
//         "RU": 3000 //Russia
//     };

//         $('#world-map').vectorMap({
//         map: 'world_mill_en',
//         backgroundColor: "transparent",
//         regionStyle: {
//             initial: {
//                 fill: '#e4e4e4',
//                 "fill-opacity": 1,
//                 stroke: 'none',
//                 "stroke-width": 0,
//                 "stroke-opacity": 1
//             }
//         },
//         series: {
//             regions: [{
//                     values: visitorsData,
//                     scale: ["#92c1dc", "#ebf4f9"],
//                     normalizeFunction: 'polynomial'
//                 }]
//         },
//         onRegionLabelShow: function(e, el, code) {
//             if (typeof visitorsData[code] != "undefined")
//                 el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
//         }
//     });
</script>
