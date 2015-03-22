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
                <div id="myfirstchart" style="height: 250px;"></div>
                <!-- <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div> -->
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
        </div><!-- /.nav-tabs-custom -->
    </section>
    <!-- </div> -->

    <?php
    $uniqueBeers = beerTrackDBQuery("SELECT DISTINCT beerstore_beer_ID, single_package_type, single_package_volume, single_package_quantity FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID'");
                    
    while($beers = mysqli_fetch_array($uniqueBeers)) {
        echo $beers['beerstore_beer_ID'] . '</br>';
        echo $beers['single_package_type'] . '</br>';
        echo $beers['single_package_volume'] . '</br>';
        echo $beers['single_package_quantity'] . '</br>';
    }
    ?>

<table id="allStoresTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Beer</th>
                            <th>Location</th>
                            <th>Package Type</th>
                            <th>Unit Volume</th>
                            <th>Quanity per Package</th>
                            <!-- <th>Packages Sold</th> -->
                            <th>Packages Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    $listings = queryDatabaseForLatestInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity);
                    
                    while($row = mysqli_fetch_array($listings)) {
                        // print_r($row);
                        echo "<tr>";
                        echo "<td>" . substr($row['run_timestamp'], 0, 10) . "</td>";
                        echo "<td>" . $row['beer_name'] . "</td>";
                        echo "<td>" . $row['location_name'] . "</td>";
                        echo "<td>" . $row['single_package_type'] . "</td>";
                        echo "<td>" . $row['single_package_volume'] . " ml</td>";
                        echo "<td>" . $row['single_package_quantity'] . "</td>";
                        // echo "<td>" . $row['stock_at_timestamp'] . "</td>";
                        echo "<td>" . calcSalesThatDay($row[2], $row[3], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";
                        
                        // echo "<td>" . calcSalesThatDay($row['beerstore_beer_ID'], $row['beerstore_store_ID'], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";
                        // echo "<td class=\"options-align-right\"> <a href=\"?viewName=edit&storeId=" . $row['store_id'] . "\"><button class=\"btn btn-xs btn-primary\">Edit Store</button></a></td>";
                        echo "</tr>";

                    }

                    ?>
                    </tbody>

                </table>



<script type="text/javascript">
new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value'],
  hideHover: 'false'
});
</script>
