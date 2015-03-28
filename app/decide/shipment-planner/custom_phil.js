//copied from GMAPS:
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var canada = new google.maps.LatLng(45.4000, -75.6667);
  var mapOptions = {
    zoom: 10,
    center: canada,
    disableDefaultUI: true
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);


}

function calcRoute() {
  var start = document.getElementById('start').innerHTML;
  var end = document.getElementById('end').innerHTML;
  var waypts = [];
  var checkboxArray = document.getElementById('waypoints');
  for (var i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected == true) {
      waypts.push({
          location:checkboxArray[i].value,
          stopover:true});
    }
  }

  var request = {
      origin: start,
      destination: end,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions_panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);



//Phil's stuff:

function includeStoreCheck (className) {
	var decision = $("#decider_" + className ).val();
	if(decision === "include")
	{
		$(".items_" + className).each(function( index ) {
			$( this ).css("display", "table-row");
		});
		//selecting the item in the google maps world
		$("#storeID_"  + className ).removeClass('notpicked');
		$("#storeIDList_"  + className ).css("display", "block");
	}
	if(decision === "exclude")
	{
		$(".items_" + className).each(function( index ) {
			$( this ).css("display", "none");
			$("#storeID_"  + className ).addClass('notpicked');
			$("#storeIDList_"  + className ).css("display", "none");
		});
	}
}


$( document ).ready(function() {

  //processing the shipment plan
  $("#processShipmentPlan").click(function(){
    $(".beerQFeild").each(function( index ) {
      if($( this ).val().length > 0)
      {
        var beerQName = $( this ).attr('name').split('_');
        console.log(beerQName)

        //6 x Can 473 ml
        var making_inventory_package_option = beerQName[4] + ' x ' + beerQName[3] + ' ' + beerQName[5] + ' ml';

        var URLMake = "/app/decide/shipment-planner/process_inventory_update.php?breweryIDPassed=" + $("#loggedInBreweryID").text() + "&beerIDPassed=" + beerQName[1] + "&inventory_package_option=" + making_inventory_package_option + "&quantity_ordered=" + $( this ).val() + "&location=" + beerQName[2] 

        console.log(URLMake);

        $.get(URLMake, function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
        });



        // $.post("process_inventory_update.php",
        // {
        //     breweryIDPassed: $("#loggedInBreweryID").text(),
        //     beerIDPassed: beerQName[1],
        //     inventory_package_option: making_inventory_package_option,
        //     quantity_ordered: $( this ).val(),
        //     location: beerQName[2]
        // },
        // function(data, status){
        //     alert("Data: " + data + "\nStatus: " + status);
        // });

      }
    });
  });

//resetting the google map based on which stores we're going to...  
	$("#collapseDeliveryToggle").click(function(){
		$("#collapseTwo").css('display', 'inline-block');
		initialize(); //resetting google map

		//clears them all
		$("#waypoints option:selected").removeAttr("selected");

		//re selects the right ones...
		$(".storeSelectOption").each(function( index ) {
			if($( this ).hasClass('notpicked'))
			{
				$( this ).removeAttr("selected");
			}
			else
			{
				$( this ).attr('selected', 'selected');
			}
		});

		setTimeout(function(){calcRoute(); console.log('ran calcRoute');},500);

	})
})
