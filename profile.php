<?php
  include "header/header-control.php";
  if($_SESSION['logon']<1) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
?>

<?php if($_SESSION['logon'] >=1) : ?>
<html>
<head>
<?php include "header/header-head.php"; ?>
</head>
<body>
<?php include "header/header-body.php"; ?>
<div class="container">
  <div class="row main" align="center">
    <h1>Profile Information</h1>
  </div>
  <div class="row main" align="center">
    <h3>Username: </h3>
  </div>
  <div class="row main" align="center">
    <h3>Email: </h3>
  </div>
  <div class="row main" align="center">
    <h3>Moneys: </h3>
  </div>
</div>
</body>
<?php endif; ?>
