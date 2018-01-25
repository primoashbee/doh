<html>
	<body>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAmax-o29L6uMibCrMDckagdxgnTynSMOU&libraries=visualization"></script>


    <div id="googleMap"></div>
	<script>
		
  var MIN_NO_ACC = 520;
  var MAX_NO_ACC = 6119;
function initialize() {
    geocoder = new google.maps.Geocoder();
  var mapProp = {
    center:new google.maps.LatLng(40.785091,-73.968285),
    zoom:11,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  codeAddress("10001", 6119);
  codeAddress("10002", 5180);
  codeAddress("10003", 4110);
  codeAddress("10004", 899);
  codeAddress("10005", 520);
  codeAddress("10006", 599);

   function codeAddress(zip, noAccidents) {
    //var address = document.getElementById("address").value;
geocoder.geocode( { 'address': zip}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);

        var hotSpot = results[0].geometry.location;
        console.log(hotSpot + " " + noAccidents);

        var heatMapZip = [
        {location: hotSpot, weight: noAccidents}

        ];

       var color =[
            "#ff0000",
            "#00ff00"
        ];

        var heatmap = new google.maps.visualization.HeatmapLayer({
          data: heatMapZip,
          radius: 50,
          dissapating: false
        });
          
        var rate = (noAccidents-MIN_NO_ACC)/(MAX_NO_ACC-MIN_NO_ACC+1);
          console.log(rate);
        var gradient = [
            'rgba('+Math.round(255*rate)+', '+Math.round(255*(1-rate))+', 0, 0)',
            'rgba('+Math.round(255*rate)+', '+Math.round(255*(1-rate))+', 0, 1)'];
        heatmap.set('gradient', gradient);
        heatmap.setMap(map);

      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }


}

google.maps.event.addDomListener(window, 'load', initialize);
    


	</script>
	</body>
</html>