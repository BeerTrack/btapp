<section class="col-lg-6 connectedSortable">
  <div class="box box-primary homepage-dashboard-box">
    <div class="box-header">
      <h3 class="box-title">Beerstore Inventory Levels Over Time</h3>
    </div>

    <div class="box-body">
      <form method="get">
        <div class="input-group input-group-sm">
          <select style="border-radius: 0px !important; -webkit-appearance: inherit;" id="widStoreFilterGraph" name="widStoreFilterGraph" class="form-control">
            <option value="">Click to select a store...</option>
            <option value="all">All Stores</option>
            <?php
            //getting names of the stores associated with this brewery
            $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM stores WHERE brewery_id = '$loggedInBreweryID' ORDER BY location_name");

            while($row = mysqli_fetch_array($displayTransactionQuery)) 
            {
              echo "<option value=\"" . $row['beerstore_store_id']  . "\">" . $row['location_name'] . "</option>";
            }
            ?>
          </select>
          <span class="input-group-btn">
            <button class="btn btn-info btn-flat" type="submit">Filter</button>
          </span>
        </div>
      </form>
      <div class="chart tab-pane active" id="allBeerstoresInventoryOverTime"></div>
    </div>
    
  </div>
</section>


<?php

$storeForFilteringGraph = $_GET['widStoreFilterGraph'];
if(strlen($storeForFilteringGraph) < 1)
{
  $storeForFilteringGraph = 'all';
}

$dataPoints = array();
$dataPointNames = array();
$todaysDate = date("Y-m-d");
$daysToDo = 7;

$catcherToStopToManyNames = 0;

for ($daysBack=0; $daysBack < $daysToDo; $daysBack++) { 
  $dateToRunWith = date('Y-m-d', strtotime($todayTarget . ' - ' . $daysBack . ' days'));

  $listings = queryDatabaseForInventoryStoreFilter($dateToRunWith, $storeForFilteringGraph);
  $dataRowMaking = "{ day: '" . $dateToRunWith . "'";
  while($row = mysqli_fetch_array($listings)) {
    $can_bottle_descSpaceless = "'" . $row['can_bottle_desc'] . "'";
    $dataRowMaking .= ', ' . $can_bottle_descSpaceless . ': ' . $row[7];
    if($catcherToStopToManyNames < 1)
    {
      array_push($dataPointNames, $can_bottle_descSpaceless);
    }
  }
  $dataRowMaking .= "}";
  $catcherToStopToManyNames = $catcherToStopToManyNames + 1;

  $dataPoints[$daysBack] = $dataRowMaking;
}

//making JS:
$dataPointsMaking = 'data: [';
for ($i=($daysToDo - 1); $i >= 0 ; $i--) { 
  $dataPointsMaking .= $dataPoints[$i];
  if($i != 0)
  {
    $dataPointsMaking .= ',';
  }
}
$dataPointsMaking .= ']';

$keyLabelsMaking = '[';
for ($iKeysLabels=0; $iKeysLabels < count($dataPointNames); $iKeysLabels++) { 
  $keyLabelsMaking .= "" . $dataPointNames[$iKeysLabels] . "";
  if($iKeysLabels != count($dataPointNames) -1)
  {
    $keyLabelsMaking .= ", ";
  }
}
$keyLabelsMaking .= "]";

?>


<!-- linking PHP and javascript in order to produce the bar graph -->
<script type="text/javascript">
    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'allBeerstoresInventoryOverTime',
      // The name of the data record attribute that contains x-values.
      xkey: 'day',
      hideHover: 'auto',
      // Chart data records
      <?php echo $dataPointsMaking; ?> ,
      // A list of names of data record attributes that contain y-values.
      ykeys: <?php echo $keyLabelsMaking; ?> ,
      // Labels for the ykeys 
      labels: <?php echo $keyLabelsMaking; ?>
    });

</script>
