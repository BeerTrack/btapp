<!-- Template/Sample code from: http://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example/3059129#3059129 -->
<?php if($showingCourse == 'MSCI444'){ ?>
<section class="col-lg-12 connectedSortable">
<?php } ?>
<?php if($showingCourse == 'MSCI436'){ ?>
<section class="col-lg-6 connectedSortable">
<?php } ?>


<div class="box box-solid bg-light-blue-gradient homepage-dashboard-box">
  <div class="box-header">
    <i class="fa fa-map-marker"></i>
    <h3 class="box-title">
      Store Locations
    </h3>
  </div>
  <div class="box-body">
    <ul style="display:none">
      <?php
      $displayTransactionQuery = beerTrackDBQuery("SELECT * FROM stores WHERE brewery_id = '$loggedInBreweryID' ORDER BY location_name");

      while($row = mysqli_fetch_array($displayTransactionQuery)) {
        echo "<li class=\"storesOnMap\">" . $row['location_address'] . "</li>";
      }
      ?>
    </ul>

    <div id="map" style="width: 100%;" class="gmaps-homepage"></div>

  </div>
</div>
</section>


<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<script type="text/javascript">

var arrayOfLatLongs = [];

function getLatLong(beerStoreAddress)
{
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode( { 'address': beerStoreAddress}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        var latLongArray = [latitude, longitude];
        arrayOfLatLongs.push(latLongArray);
    }

    if(($('.storesOnMap').length - 1) == arrayOfLatLongs.length)
    {
        makeMapWithMarkers(arrayOfLatLongs);
    }

    }); 
}


$(".storesOnMap").each(function( index ) {
    var latLongForThisStore = getLatLong($(this).text());
});

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      disableDefaultUI: true,
      center: new google.maps.LatLng(43.7, -79.4),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });


function makeMapWithMarkers(locations)
{
    var infowindow = new google.maps.InfoWindow();
    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      createMarker(new google.maps.LatLng(locations[i][0], locations[i][1]), map);
    }
  }


function createMarker(pos, mapPass) {
    var contentString = '<div id="content">'+
      '<p id="" class="" style="color: black; font-weight: bold">Store Details</p>'+
      '<p><a href="/app/report/sales-inventory/">View Inventory</a></p>'+
      '<p><a href="/app/global/manage-stores/">Manage Store</a></p>'+
      '</div>';

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });

    var marker = new google.maps.Marker({       
        position: pos, 
        map: mapPass
    });

    google.maps.event.addListener(marker, 'click', function() { 
       infowindow.open(map,marker);
    }); 
    return marker;  
}
</script>