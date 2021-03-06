// START Google Maps API
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

// sample code provided by google maps api to display markers on map
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

// sample code provided by google maps api to display markers on map
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

      //building the timeline of deliveries
      for (var i = (route.legs.length - 1); i >= 0; i--) {
        var routeSegment = i + 1;
        var tempTimelimeItem = '';
        tempTimelimeItem += '<li id="" class="timelineItemGMaps">';
        tempTimelimeItem += '<i class="fa fa-truck bg-aqua"></i><div class="timeline-item">';
        tempTimelimeItem +=  '<span class="time"><i class="fa fa-location-arrow"></i> ' + route.legs[i].distance.text + '</span>';
        tempTimelimeItem += '<h3 class="timeline-header"> Segment #' + routeSegment + '</h3>';
        tempTimelimeItem += '<div class="timeline-body">'+ route.legs[i].start_address + '</br> to </br>';
        tempTimelimeItem += route.legs[i].end_address + '<br></div></div></li>';
        if(i != (route.legs.length - 1))
        {
          tempTimelimeItem += '<li id="" class="timelineItemGMaps">';
          tempTimelimeItem += '<i class="fa fa-user bg-aqua"></i><div class="timeline-item">';
          tempTimelimeItem += '<h3 class="timeline-header"> Delivery #' + routeSegment + '</h3>';
          tempTimelimeItem += '<div class="timeline-body">'+ route.legs[i].end_address + '</div></div></li>';
        }

        $( tempTimelimeItem ).insertAfter("#firstStoreDelivery");
      }

      //removing the locator marker we needed originally
      $("#firstStoreDelivery").remove();
    }
  });
}

//running the initlize function on load (although we re run it as the manifest is updated)
google.maps.event.addDomListener(window, 'load', initialize);
// END Google Maps API


//removing and re adding the store and inventory data to the manifest as needed
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

//hiding the areas we don't need on print, then printing them.
function printShippingPlan () {
  $("#distribute").addClass('hidePrint');
  $("#finalize").addClass('hidePrint');

  window.print();

  $("#distribute").removeClass('hidePrint');
  $("#finalize").removeClass('hidePrint');
}

//constantly listening for functions in the document ready below
$( document ).ready(function() {
  //processing the shipment plan
  $("#processShipmentPlan").click(function(){
    $(".beerQFeild").each(function( index ) {
      if($( this ).val().length > 0)
      {
        var beerQName = $( this ).attr('name').split('_');
        var making_inventory_package_option = beerQName[4] + ' x ' + beerQName[3] + ' ' + beerQName[5] + ' ml';
        var URLMake = "/app/decide/shipment-planner/process_inventory_update.php?breweryIDPassed=" + $("#loggedInBreweryID").text() + "&beerIDPassed=" + beerQName[1] + "&inventory_package_option=" + making_inventory_package_option + "&quantity_ordered=" + $( this ).val() + "&location=" + beerQName[2] 
        //making the call to update the inventory table
        $.get(URLMake, function(data, status){
        });
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

    //delates the calc route function in order to make sure the map is loaded properly (without visual errors)
		setTimeout(function(){calcRoute(); console.log('ran calcRoute');},500);

	})
}) //end of document ready
