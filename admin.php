<?php
  session_start();
  if($_SESSION['logon']<3) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
  if($_SESSION['logon']==3) {
    include "header.php";
    }
?>
<html>
<head>
  <title>Admin Page</title>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css">
   <link rel="stylesheet" href="style/admin.css">
   <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
   <script src="js/realtime.js"></script>
</head>
<body>

<?php if($_SESSION['logon']>=3) : ?>
  <ul class="nav nav-tabs navbar-fixed-bottom" id="bottom_navbar">
  <li><a href="">Jock Lot</a></li>
  <li><a href="">A Wing Lot</a></li>
  <li><a href="">PA Wing Lot</a></li>
</ul>
<div class="custom-popup" id="map"></div>

<script src="js/admin.js"></script>

<?php endif; ?>

</body>
</html>
