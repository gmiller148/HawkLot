<?php session_start();  ?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
  <ul>
  <li><a class="active" href="index.php">Home</a></li>
  <?php if($_SESSION['logon']<1) : ?>
  <li><a href="register.php">Register</a></li>
  <?php endif; ?>
  <?php if($_SESSION['logon']>=3) : ?>
    <li><a href="admin.php">Admin Access</a></li>
    <li><a href="user.php">User Access</a></li>
  <?php endif; ?>
  <li class="dropdown">
    <a href="" class="dropbtn">More</a>
    <div class="dropdown-content">
      <a href="aboutus.php">About Us</a>
      <a href="ourstory.php">Our Story</a>
    </div>
  </li>
  <?php if($_SESSION['logon']>=1) : ?>
    <li><a href="reroute.php?logout=true">Logout</a></li>
  <?php endif; ?>
  </ul>
</hmtl>
</body>
