<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Create Shipping Manifest</h3>
      </div>
      <div class="box-body">
        <table id="allStoresTable" class="table table-hover table-bordered">
          <thead>
            <tr style="background-color: #ECECEC">
              <th>Beer</th>
              <th>Package Type</th>
              <th>Unit Volume</th>
              <th>Quanity per Package</th>
              <th>Current Inventory Level</th>
              <th>Quanity to Ship</th>
            </tr>
          </thead>
          <tbody>
          <?php
          function rowCreatorPerStore($loggedInBreweryID, $passedBeerStoreID, $storeNamePrint)
          {
            $possibleBeersQuery = beerTrackDBQuery(
              "SELECT s.location_name, bb.beer_name, ipd.single_package_type, ipd.single_package_volume, ipd.single_package_quantity, ipd.stock_at_timestamp
              FROM stores s, beer_brands bb, inventory_parsing ipd
              WHERE 
              s.brewery_id = '$loggedInBreweryID' AND
              s.beerstore_store_id = '$passedBeerStoreID' AND
              ipd.brewery_id = s.brewery_id AND
              ipd.beerstore_beer_id = bb.beerstore_beer_id AND
              ipd.beerstore_store_id = s.beerstore_store_id
              ORDER BY s.location_name");

            echo '<tr style="background-color: #ECECEC"><td colspan="6"><strong>' . $storeNamePrint . '</strong>';
            // echo '<td colspan="1"><div class="form-group" style="margin-bottom:0px; float: right"><label style="margin-bottom:0px;"class="">Include in Shipment Plan<div style="display:inline; margin-left: 10px;   top: -2px;  position: relative;" class="includeStoreCheck icheckbox_minimal-blue checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" onClick="alert(\'Hello from JavaScript!\')" name="" id="test" class="minimal" checked="" style="position: absolute; opacity: 0;"></div></label></div></td></tr>';
            // echo '<td colspan="1"><label style="margin-bottom:0px;"class="">Include in Shipment Plan<input type="checkbox" onClick="alert(\'Hello from JavaScript!\')" name="" class="checkbox" checked="" style="position: absolute; opacity: 0;"></label></div></td></tr>';
            echo '
            <div class="form-group" style="margin-bottom: 0px; float: right">
                <select id="decider_' . $passedBeerStoreID  . '" onChange="includeStoreCheck(\'' . $passedBeerStoreID . '\')" name="inventory_location" class="includeStoreCheck form-control">
                    <option value="include">Include in Shipment Plan</option>
                    <option value="exclude">Exclude from Shipment Plan</option>
                </select>
            </div>
            </tr>';


            while($row = mysqli_fetch_array($possibleBeersQuery)) {
              // print_r($row);
              echo "<tr class=\"items_" . $passedBeerStoreID . "\">";
              echo "<td>" . $row['beer_name'] . "</td>";
              echo "<td>" . $row['single_package_type'] . "</td>";
              echo "<td>" . $row['single_package_volume'] . " ml</td>";
              echo "<td>" . $row['single_package_quantity'] . "</td>";
              echo "<td>" . $row['stock_at_timestamp'] . "</td>";
              echo "<td><input style=\"float:right; width:100%\" type=\"text\"></td>";
              echo "</tr>";
            }
          }

          $possibleStoresQuery = beerTrackDBQuery("SELECT * FROM stores WHERE brewery_id = '$loggedInBreweryID'"); 
          while($singleStore = mysqli_fetch_array($possibleStoresQuery)) {
            rowCreatorPerStore($loggedInBreweryID, $singleStore['beerstore_store_id'], $singleStore['location_name']);
          }
          ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//Hide all rows for a given store

// $('.icheckbox_minimal').click(function() {
//   console.log('clicked'); 
//     if(this.attr("aria-checked") == "true")
//     {
//         //Do stuff
//         alert('test - true');
//     }
//     else 
//     {
//       alert(this.attr("id"))
//     }
// });

// $(".includeStoreCheck").change(function() {
//   console.log(this.val());

//     // if(this.attr("value") == "include")
//     // {
//     //     alert('test - include');
//     // }
//     // else 
//     // {
//     //   alert('test - exclude');
//     // }
// });

function includeStoreCheck (className) {
  var decision = $("#decider_" + className ).val();
  if(decision === "include")
  {
    $(".items_" + className).each(function( index ) {
      $( this ).css("display", "table-row");
    });
  }
  if(decision === "exclude")
  {
    $(".items_" + className).each(function( index ) {
      $( this ).css("display", "none");
    });
  }
}


</script>

    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAfsoOmZeHXm5M4O_fMZWb9yL0VJBP6ZCU"></script>
    <script src="gmaps_api.js"></script>


    <div id="map-canvas" style="float:left;width:70%;height:100%;"></div>
    <div id="control_panel" style="float:right;width:30%;text-align:left;padding-top:20px">
    <div style="margin:20px;border-width:2px;">
    <b>Start:</b>
    <select id="start">
      <option value="Halifax, NS">Halifax, NS</option>
      <option value="Boston, MA">Boston, MA</option>
      <option value="New York, NY">New York, NY</option>
      <option value="Miami, FL">Miami, FL</option>
    </select>
    <br>
    <b>Waypoints:</b> <br>
    <i>(Ctrl-Click for multiple selection)</i> <br>
    <select multiple id="waypoints">
      <option value="montreal, quebec">Montreal, QBC</option>
      <option value="toronto, ont">Toronto, ONT</option>
      <option value="chicago, il">Chicago</option>
      <option value="winnipeg, mb">Winnipeg</option>
      <option value="fargo, nd">Fargo</option>
      <option value="calgary, ab">Calgary</option>
      <option value="spokane, wa">Spokane</option>
    </select>
    <br>
    <b>End:</b>
    <select id="end">
      <option value="Vancouver, BC">Vancouver, BC</option>
      <option value="Seattle, WA">Seattle, WA</option>
      <option value="San Francisco, CA">San Francisco, CA</option>
      <option value="Los Angeles, CA">Los Angeles, CA</option>
    </select>
    <br>
      <input type="submit" onclick="calcRoute();">
    </div>
    <div id="directions_panel" style="margin:20px;background-color:#FFEE77;"></div>
    </div>
