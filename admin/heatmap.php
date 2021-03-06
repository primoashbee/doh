<?php 
require "../config.php";
require "../functions2.php";
session_start();
if(isset($_SESSION['old_user'])){
unset($_SESSION['old_user']);
};

if(checkIfLoggedIn()==false){
  header('location:../index.php');

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Heatmaps</title>
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
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 25%;
        padding: 5px;
        position: absolute;
        top: 10px;
        z-index: 5;
      }
    </style>
  </head>

  <body>
    <div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
    </div>
    <div id="map"></div>
    <script>

      // This example requires the Visualization library. Include the libraries=visualization
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">

      var map, heatmap,center;
  center ={lat: 14.678672690466012, lng: 120.54104804992676}

      
      function initMap() {
        
        if(getPoints().length>0){
          center = getPoints()[0]
        }
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: center,

          mapTypeId: 'terrain'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map
        });
        changeRadius();
      }

      function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }

      function changeGradient() {
        var gradient = [
          'rgba(0, 255, 255, 0)',
          'rgba(0, 255, 255, 1)',
          'rgba(0, 191, 255, 1)',
          'rgba(0, 127, 255, 1)',
          'rgba(0, 63, 255, 1)',
          'rgba(0, 0, 255, 1)',
          'rgba(0, 0, 223, 1)',
          'rgba(0, 0, 191, 1)',
          'rgba(0, 0, 159, 1)',
          'rgba(0, 0, 127, 1)',
          'rgba(63, 0, 91, 1)',
          'rgba(127, 0, 63, 1)',
          'rgba(191, 0, 31, 1)',
          'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }

      function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }

      // Heatmap data: 500 Points
      function getPoints() {
        
      return [
        <?php
        $qry = array();
        if(isset($_SESSION['QRY_STRING'])){
          $qry = $_SESSION['QRY_STRING'];
        }
          $qry = qryOutbreak($qry);
          $ctr=0;
          $total = count($qry);
          foreach ($qry as $key => $value) {
            
              $ctr++;
              if($ctr<$total){
                ?>

                new google.maps.LatLng(<?=$value['lattitude']?>,<?=$value['longitude']?>),
                <?php 
                }else{
                  ?>
                
                 new google.maps.LatLng(<?=$value['lattitude']?>,<?=$value['longitude']?>)
                  <?php
                  } 
                }
            ?>
        
      ]
    }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmax-o29L6uMibCrMDckagdxgnTynSMOU&libraries=visualization&callback=initMap">
    </script>
  </body>
</html>
<?php unset($_SESSION['QRY_STRING']); ?>