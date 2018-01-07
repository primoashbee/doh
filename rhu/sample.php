<!DOCTYPE html>
<html>
  <head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
      <input id="address" type="textbox" value="Olongapo, Philippines">
      <input id="submit" type="button" value="Geocode">
    </div>
    <div id="map"></div>
    <input type="text" id="lat">
    <input type="text" id="long">
    <script>
    var marker;
    var result;
    var map;
    
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
        

        map.addListener('click', function(event) {
         if (marker != undefined){
                marker.setPosition(event.latLng)
                    //updateLatLng()
                } else {
                    marker = new google.maps.Marker({
                        position: event.latLng,
                        map: map,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        //icon: "/content/images/map-pin-icon.png"
                    });

                    //updateLatLng()
                    marker.addListener('dragend', function (obj) {
                    //updateLatLng()
                    });
                }
             
             document.getElementById('lat').value = marker.getPosition().lat()
            document.getElementById('long').value = marker.getPosition().lng()
             

        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        var latitude,longitude;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
	         latitude = results[0].geometry.location.lat();
             longitude = results[0].geometry.location.lng();
            console.log(results);
            console.log(latitude)
            console.log(longitude)
            document.getElementById('lat').value = latitude
            document.getElementById('long').value = longitude
			map.setCenter({lat:latitude, lng: longitude})
			console.log("DFDF")
			if(marker != undefined){
				marker.setPosition( {lat:latitude, lng: longitude})
	        }else{
          		marker = new google.maps.Marker({
	            map: map,
	            position:  {lat:latitude, lng: longitude},
	            draggable: true,
	            animation: google.maps.Animation.DROP
	        });
	        
	        }
	        /*
            resultsMap.setCenter(results[0].geometry.location);
              marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location,

            });*/
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmax-o29L6uMibCrMDckagdxgnTynSMOU&callback=initMap">
    </script>
  </body>
</html>