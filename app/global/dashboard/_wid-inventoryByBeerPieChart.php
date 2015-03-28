<section class="col-lg-3 connectedSortable">
  <div class="box box-primary homepage-dashboard-box">
      <div class="box-header">
        <h3 class="box-title">Today's Beerstore Inventory Levels (By Package)</h3>
      </div>
      <div class="box-body">
            <div class="chart tab-pane active" id="donut-inventory-by-beer"></div>
        </div>
    </div>
</section>


<?php

$storeForFilteringGraph = 'all';

$dataPoints = array();
$dataPointNames = array();
$todaysDate = date("Y-m-d");

$catcherToStopToManyNames = 0;

$dateToRunWith = date('Y-m-d', strtotime($todayTarget));

$listings = queryDatabaseForInventoryStoreFilter($dateToRunWith, $storeForFilteringGraph);

$dataRowMaking = 'data: [';
while($row = mysqli_fetch_array($listings)) {
  if($catcherToStopToManyNames != 0)
  {
    $dataRowMaking .= ', ';
  }

  $dataRowMaking .= "{ label: '" . $row['can_bottle_desc'] . "', ";
  $dataRowMaking .= "value: '" . $row[7] . "'} ";
  $catcherToStopToManyNames = $catcherToStopToManyNames + 1;
}
$dataRowMaking .= "]";

?>


<script type="text/javascript">

Morris.Donut({
  element: 'donut-inventory-by-beer',
  <?php echo $dataRowMaking; ?> 
  // data: [
  //   {label: "Download Sales", value: 12},
  //   {label: "In-Store Sales", value: 30},
  //   {label: "Mail-Order Sales", value: 20}
  // ]
});



    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'allBeerstoresInventoryOverTime1',
      // The name of the data record attribute that contains x-values.
      xkey: 'day',
      hideHover: 'auto',
      // Chart data records
      <?php echo $dataPointsMaking; ?> ,
      // data: [
      //   { day: '2015-03-18', beerA: 20, beerB: 26 },
      //   { day: '2015-03-19', beerA: 10, beerB: 11 },
      //   { day: '2015-03-20', beerA: 5, beerB: 9 },
      //   { day: '2015-03-21', beerA: 5, beerB: 3 },
      //   { day: '2015-03-22', beerA: 20, beerB: 10 }
      // ],
      // A list of names of data record attributes that contain y-values.
      ykeys: <?php echo $keyLabelsMaking; ?> ,
      // Labels for the ykeys 
      labels: <?php echo $keyLabelsMaking; ?>
    });


    // new Morris.Line({
    //   // ID of the element in which to draw the chart.
    //   element: 'store2chart',
    //   // Chart data records
    //   data: [
    //     { day: '2015-03-18', beerA: 45, beerB: 32 },
    //     { day: '2015-03-19', beerA: 32, beerB: 31 },
    //     { day: '2015-03-20', beerA: 10, beerB: 20 },
    //     { day: '2015-03-21', beerA: 1, beerB: 8 },
    //     { day: '2015-03-22', beerA: 50, beerB: 7 }
    //   ],
    //   // The name of the data record attribute that contains x-values.
    //   xkey: 'day',
    //   // A list of names of data record attributes that contain y-values.
    //   ykeys: ['beerA', 'beerB'],
    //   // Labels for the ykeys 
    //   labels: ['Beer A', 'Beer B'],
    //   hideHover: 'true'
    // });
</script>
