<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['hid']))
  {
  header('location:login.php');
  }
  else {
    $hid = $_SESSION['hid'];
    $sql = "select bloodrequest.*, receivers.* from bloodrequest, receivers where hid='$hid' && bloodrequest.rid=receivers.id";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <title>Search Nereby</title>
  <style>
    *{
      margin: 0;
      padding: 0;
    }
    #map{
      width: 100%;
      height: 100vh;
    }
    h3,p{
      text-align: center;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
  <script type="text/Javascript">
    <?php
    $get = "select * from hospitals where id='$hid'";
    $get_result = mysqli_query($conn,$get);
    $get_arr = mysqli_fetch_array($get_result);
    ?>
    var map = L.map('map').setView([<?php echo $get_arr['hlatitude']; ?>,<?php echo $get_arr['hlongitude']; ?>], 8);

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(map);
    // Search Geo-Coder SYstem
    L.Control.geocoder().addTo(map);
    // L.marker([11.0168,76.9558]).addTo(map);
    <?php 
    $hdata = "select * from hospitals";
    $hospitals = mysqli_query($conn,$hdata);
    while ($location = mysqli_fetch_array($hospitals)){ ?>
      var myIcon = L.icon({
        iconUrl: 'image/hospital3.png',
        iconSize: [50, 50],
        iconAnchor: [25, 16],
      });
      L.marker([<?php echo $location['hlatitude'];?>,<?php echo $location['hlongitude'];?>],{icon: myIcon}).addTo(map).bindPopup('<h3><?php echo $location['hname']?></h3><p><?php echo $location['hcity'] ?></p>');
    <?php
    }
    ?>
    <?php 
    $rdata = "select * from receivers";
    $receivers = mysqli_query($conn,$rdata);
    while ($loc = mysqli_fetch_array($receivers)){ ?>
      var myIcon = L.icon({
        iconUrl: 'image/user.png',
        iconSize: [50, 50],
        iconAnchor: [25, 16],
      });
      L.marker([<?php echo $loc['rlatitude'];?>,<?php echo $loc['rlongitude'];?>],{icon: myIcon}).addTo(map).bindPopup('<h3><?php echo $loc['rname']; ?></h3><p><?php echo $loc['rcity']; ?></p>');
    <?php
    }
    ?>
  </script>
  <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>