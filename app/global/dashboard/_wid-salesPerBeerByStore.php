    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class=""><a href="#store2chart" data-toggle="tab" aria-expanded="false">Store #2</a></li>
                <li class="active"><a href="#store1chart" data-toggle="tab" aria-expanded="true">Store #1</a></li>
                <li class="pull-left header"><i class="fa fa-inbox"></i> Beer Sales By Store</li>
            </ul>

            <div class="tab-content no-padding">
                <div class="chart tab-pane active" id="store1chart"></div>
                <div class="chart tab-pane" id="store2chart"></div>
            </div>
        </div>
    </section>






    <?php
    // $uniqueBeers = beerTrackDBQuery("SELECT DISTINCT beerstore_beer_ID, single_package_type, single_package_volume, single_package_quantity FROM inventory_parsing WHERE brewery_id = '$loggedInBreweryID'");
                    
    // while($beers = mysqli_fetch_array($uniqueBeers)) {
    //     echo $beers['beerstore_beer_ID'] . '</br>';
    //     echo $beers['single_package_type'] . '</br>';
    //     echo $beers['single_package_volume'] . '</br>';
    //     echo $beers['single_package_quantity'] . '</br>';
    // }
    ?>

<!-- <table id="allStoresTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Beer</th>
                            <th>Location</th>
                            <th>Package Type</th>
                            <th>Unit Volume</th>
                            <th>Quanity per Package</th>
                            <th>Packages Sold</th>
                        </tr>
                    </thead>
                    <tbody> -->
                    <?php

                    // $listings = queryDatabaseForLatestInventory($inventory_beerstore_id, $inventory_location, $timespanForInventoryLookup, $inventory_package_type, $inventory_package_single_volume, $inventory_package_quanity);
                    
                    // while($row = mysqli_fetch_array($listings)) {
                    //     // print_r($row);
                    //     echo "<tr>";
                    //     echo "<td>" . substr($row['run_timestamp'], 0, 10) . "</td>";
                    //     echo "<td>" . $row['beer_name'] . "</td>";
                    //     echo "<td>" . $row['location_name'] . "</td>";
                    //     echo "<td>" . $row['single_package_type'] . "</td>";
                    //     echo "<td>" . $row['single_package_volume'] . " ml</td>";
                    //     echo "<td>" . $row['single_package_quantity'] . "</td>";
                    //     // echo "<td>" . $row['stock_at_timestamp'] . "</td>";
                    //     echo "<td>" . calcSalesThatDay($row[2], $row[3], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";
                        
                    //     // echo "<td>" . calcSalesThatDay($row['beerstore_beer_ID'], $row['beerstore_store_ID'], $row['run_timestamp'], $row['can_bottle_desc'], $row['stock_at_timestamp']) . "</td>";
                    //     // echo "<td class=\"options-align-right\"> <a href=\"?viewName=edit&storeId=" . $row['store_id'] . "\"><button class=\"btn btn-xs btn-primary\">Edit Store</button></a></td>";
                    //     echo "</tr>";

                    // }

                    ?>
      <!--               </tbody>

                </table>
 -->


<script type="text/javascript">
    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'store1chart',
      // Chart data records
      data: [
        { day: '2015-03-18', beerA: 20, beerB: 26 },
        { day: '2015-03-19', beerA: 10, beerB: 11 },
        { day: '2015-03-20', beerA: 5, beerB: 9 },
        { day: '2015-03-21', beerA: 5, beerB: 3 },
        { day: '2015-03-22', beerA: 20, beerB: 10 }
      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'day',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['beerA', 'beerB'],
      // Labels for the ykeys 
      labels: ['Beer A', 'Beer B'],
      hideHover: 'true'
    });


    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'store2chart',
      // Chart data records
      data: [
        { day: '2015-03-18', beerA: 45, beerB: 32 },
        { day: '2015-03-19', beerA: 32, beerB: 31 },
        { day: '2015-03-20', beerA: 10, beerB: 20 },
        { day: '2015-03-21', beerA: 1, beerB: 8 },
        { day: '2015-03-22', beerA: 50, beerB: 7 }
      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'day',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['beerA', 'beerB'],
      // Labels for the ykeys 
      labels: ['Beer A', 'Beer B'],
      hideHover: 'true'
    });
</script>
