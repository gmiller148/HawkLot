<?php session_start();  ?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body{
    padding-top: 60px;
  }
  @media (max-width: 979px) {
    body {
      padding-top: 0px;
    }
  }
  </style>
</head>
<body>
  <script src="jquery/dist/jquery.js"></script>
  <script src="bootstrap/dist/js/bootstrap.js"></script>
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="">Hawklot</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <?php if($_SESSION['logon']>=3) : ?>
        <li><a href="admin.php">Admin Access</a></li>
        <?php endif; ?>
        <?php if($_SESSION['logon']>=2) : ?>
        <li><a href="renter.php">Owner Access</a></li>
        <?php endif; ?>
        <?php if($_SESSION['logon']==1) : ?>
        <li><a href="user.php">User Access</a></li>
        <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <?php if($_SESSION['logon']<1) : ?>
        <li><a href="signup.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php endif; ?>
        <?php if($_SESSION['logon']>=1) : ?>
        <li><a href="reroute.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>







</hmtl>
</body>
