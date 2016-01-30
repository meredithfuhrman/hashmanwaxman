<?php
/**
 * Plugin Name: My Google Maps Shortcode
 * Plugin URI: http://danielpataki.com
 * Description: Allows users to add flexible Google Maps to post content
 * Version: 1.0.0
 * Author: Daniel Pataki
 * Author URI: http://danielpataki.com
 * License: GPL2
 */

add_shortcode( 'api_map', 'mgms_map' );
function mgms_map( $args ) {
	$args = shortcode_atts( array(
		'lat'    => '37.3539663',
		'lng'    => '-121.95299920000002',
		'zoom'   => '8',
		'height' => '300px'
	), $args, 'map' );


	$id = substr( sha1( "Google Map" . time() ), rand( 2, 10 ), rand( 5, 8 ) );
	ob_start();
	?>
	    
    <div id="search_form">
      <input id="address" type="textbox" value="Enter address or zip">
      <input id="submit" type="button" value="Search">
    </div>
    <br>
	<div class='map' style='height:<?php echo $args['height'] ?>; margin-bottom: 1.6842em' id='map-<?php echo $id ?>'></div> 

	<script type='text/javascript'>
	var map;
	function initMap() {
	  map = new google.maps.Map(document.getElementById('map-<?php echo $id ?>'), {
	    center: {lat: <?php echo $args['lat'] ?>, lng: <?php echo $args['lng'] ?>},
	    zoom: <?php echo $args['zoom'] ?>
	  });

	    var geocoder = new google.maps.Geocoder();

	    document.getElementById('submit').addEventListener('click', function() {
	      var address = document.getElementById('address').value;
	      updateMapLocation(geocoder, map, address);
	      getLatLng(geocoder, address);
	    });
	}

// Takes entered address and changes map to center on it; plan to update to include showing markers for dispensaries
      function updateMapLocation(geocoder, resultsMap, address) {
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            resultsMap.setCenter(results[0].geometry.location);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

      function getLatLng (geocoder, address) {
        var lat = '';
        var lng = '';
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             lat = results[0].geometry.location.lat();
             lng = results[0].geometry.location.lng();
             smokereportsAPI(lat, lng);
          } else {
            alert("Lat Long geocode was not successful for the following reason: " + status);
          }
        });
      }

      // Processes the data from smokereports API
      function smokereportsAPI(lat, lng) {

        var url = "https://www.smokereports.com/api/v1.0/producers/0000000000YXPJE0000000000/availability/geo/" + lat + "/" + lng + "?jsoncallback=jsonCallBack";
        var header = "X-API-Key"
        var apiKey = "87da432a218ffcda8ded451a6e2e53361a0515ba"

        // API Call to get all Hashman Products available in a given zipcode 
        $.ajax({
          url: url,
          async: false,
          type: "GET",
          jsonpCallBack: "jsonCallBack",
          contentType: "application/json",
          dataType: "jsonp",
          headers: { header : apiKey }, 
          success: function (json) {
            
            // Create new array of product objects with just name, location, and location endpoint
            var hashmanProductList = json.data
            var products = hashmanProductList.map(getNameLocation);

            function getNameLocation (productList) {
              var product = { productName: productList["name"], locationName: productList["location"]["name"], locationLink: productList["location"]["link"]};
              return product;
            }


            // Get address from location link end point URL by making (too many) API calls
            // TO DO: Per David's suggestion, incorporate Etag here to reduce the number of request 
            // (eg, don't hit end point if received 304 Not Modified and just use values already have and store in array)
            $.each(products, function (key, value){
              
              var endpoint = value.locationLink + "?jsoncallback=jsonCallBack";

              $.ajax({
                url: endpoint,
                async: false,
                type: "GET",
                jsonpCallBack: "jsonCallBack",
                contentType: "application/json",
                dataType: "jsonp",
                headers: { header : apiKey }, 
                success: function (json) {
                  var dispensaryInfo = json.data
                  
                  value.address1 = dispensaryInfo["address"]["address1"]
                  value.address2 = dispensaryInfo["address"]["address2"]
                  value.city = dispensaryInfo["city"]
                  value.state = dispensaryInfo["state"]
                  value.zip = dispensaryInfo["address"]["zip"]
                  value.url = dispensaryInfo["url"]

                   var displayProduct = []
                   displayProduct.push( 
						"<li class='product'>" + value.productName + "</li>", 
                   		"<a href=" + value.url + " class='location'>" + value.locationName + "</a>", 
                   		"<li class='address'>" + value.address1 + " " + value.address2 + "</li>",
                   		"<li class='citystatezip'>" + value.city + " " + value.state + " " + value.zip + "</li>",
						"<br>"
                   );


                  $( "<ul/>", {
                    "class": "my-new-list",
                    html: displayProduct.join( "" )
                  }).appendTo( "div.entry-wrap" );

                },
                error: function (e){
                  console.log(e.message);
                }
              });
            });
        },

        error: function (e) {
          console.log(e.message);
        }
      });
    }
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVClEBwMhfhUQBSoEBncJ3G30J4Lz9oD0&callback=initMap">
    </script>

	<?php
	$output = ob_get_clean();
	return $output;
}