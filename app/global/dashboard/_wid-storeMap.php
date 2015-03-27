<section class="col-lg-6 connectedSortable">
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



  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>


  <div id="map" style="width: 100%;" class="gmaps-homepage"></div>

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
    // console.log($(this).text());
    // console.log(latLongForThisStore[0]);
});


function makeMapWithMarkers(locations)
{
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      // disableDefaultUI: true,
      center: new google.maps.LatLng(43.4667, -80.5167),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][0], locations[i][1]),
        map: map,
        title: 'Uluru (Ayers Rock)'
      });


  var contentString = '<div id="content">'+
      '<p id="" class="" style="color: black; font-weight: bold">Store Details</p>'+
      '<p><a href="/app/report/sales-inventory/">View Inventory</a></p>'+
      '<p><a href="/app/global/manage-stores/">Manage Store</a></p>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

 google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });

    }
}

  </script>




        </div>
    </div>
</section>