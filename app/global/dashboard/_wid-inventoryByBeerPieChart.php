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

//defining variables:
$storeForFilteringGraph = 'all';
$dataPoints = array();
$dataPointNames = array();
$todaysDate = date("Y-m-d");
$catcherToStopToManyNames = 0;
$dateToRunWith = date('Y-m-d', strtotime($todayTarget));

$listings = queryDatabaseForInventoryStoreFilter($dateToRunWith, $storeForFilteringGraph);

//making a JS array out of PHP
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

<!-- converting php into javascript chart -->
<script type="text/javascript">
//calling the morris.js chart library in order to make the pie chart
Morris.Donut({
  element: 'donut-inventory-by-beer',
  <?php echo $dataRowMaking; ?> 
});

    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'allBeerstoresInventoryOverTime1',
      // The name of the data record attribute that contains x-values.
      xkey: 'day',
      hideHover: 'auto',
      // Chart data records
      <?php echo $dataPointsMaking; ?> ,
      ykeys: <?php echo $keyLabelsMaking; ?> ,
      // Labels for the ykeys 
      labels: <?php echo $keyLabelsMaking; ?>
    });
</script>