<section class="col-lg-6 connectedSortable">
    <div class="box box-solid bg-light-blue-gradient">
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


  <div id="map" style="width: 100%; height: 400px;"></div>

  <script type="text/javascript">




// var geocoder = new google.maps.Geocoder();
// var address = "10375 Yonge St, Richmond Hill, ON L4C 3C2";

// geocoder.geocode( { 'address': address}, function(results, status) {

// if (status == google.maps.GeocoderStatus.OK) {
// var latitude = results[0].geometry.location.lat();
// var longitude = results[0].geometry.location.lng();
//     alert(latitude);
//     } 
//     else
//     {
//         alert('didnt work');
//     }
// }); 




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
      disableDefaultUI: true,
      center: new google.maps.LatLng(43.4667, -80.5167),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][0], locations[i][1]),
        map: map
      });

      // google.maps.event.addListener(marker, 'click', (function(marker, i) {
      //   return function() {
      //     infowindow.setContent(locations[i][0]);
      //     infowindow.open(map, marker);
      //   }
      // })(marker, i));
    }
}

  </script>




        </div>
    </div>
</section>