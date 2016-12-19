<?php
  include "header/header-control.php";
  if($_SESSION['logon']<3) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
?>
<html>
<head>
  <title>Admin Page</title>
  <?php if($_SESSION['logon']>=3) {
    include "/header/header-head.php";
    }
    ?>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css"></link>
   <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
   <script src="js/realtime.js"></script>
   <link rel="stylesheet" href="/style/admin.css"></link>
   <style>
   .spotInfo {
     padding: 6px 8px;
     font: 14px/16px Arial, Helvetica, sans-serif;
     background: white; background: rgba(255,255,255,1);
     box-shadow: 0 0 15px rgba(0,0,0,0.2);
     border-radius: 5px;
   }
   .spotInfo h4 {
      margin: 0 0 5px;
      color: #777;
    }
    .spotInfo p {
       margin: 0 0 4px;
     }
   </style>
</head>
<body>
<?php if($_SESSION['logon']>=3) : ?>
  <?php if($_SESSION['logon']>=3) {
    include "/header/header-body.php";
    }
  ?>

<div class="custom-popup" id="map"></div>
<script src="admin.js"></script>

<?php endif; ?>

</body>
</html>
