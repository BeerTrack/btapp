<!-- Select multiple-->
<form role="form" method="post" action="?requestedAction=makePlan">
  <div class="form-group">
    <label>Select Multiple</label>
    <select name="location[ ]" multiple="yes">
      <?php
      $locationQuery = beerTrackDBQuery("SELECT location_address * stores WHERE store_id >7 AND store_id <13");
      while($row = mysqli_fetch_array($locationQuery)
      {
        echo "<option>".$row['location_address']."</option>";
      }
      ?>
    </select>
  </div>
  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>



<!-- <!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
var map;
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html> -->
