<?php
  include "/header/header-control.php";
?>
<html lang="en">
<head>
    <title>HawkLot</title>
    <?php
      include "/header/header-head.php";
    ?>
    <style>
    .overlay{
      background: black;
      opacity: .7;
      position:fixed;
      top:0px;
      bottom:0px;
      left:0px;
      right:0px;
      z-index:100;
    }
    .box{
    position:fixed;
    top:-400px;
    left:3%;
    right:3%;
    background-color:#fff;
    color:#7F7F7F;
    padding:20px;
    border:2px solid #ccc;
    -moz-border-radius: 20px;
    -webkit-border-radius:20px;
    -khtml-border-radius:20px;
    -moz-box-shadow: 0 1px 5px #333;
    -webkit-box-shadow: 0 1px 5px #333;
    z-index:101;
}
button.close{
    float:right;
    margin-top:-17px;
    margin-right:-9px;
    cursor:pointer;
    color: #605F61;
    padding-left: 0px;
    padding-top: 0px;
    opacity: .4;
}

.close:before {
    content: "X";
}

.box h1{
    margin:-20px -20px 0px -20px;
    padding:10px;
    background-color:#FFEFEF;
    color:#EF7777;
    -moz-border-radius:20px 20px 0px 0px;
    -webkit-border-top-left-radius: 20px;
    -webkit-border-top-right-radius: 20px;
    -khtml-border-top-left-radius: 20px;
    -khtml-border-top-right-radius: 20px;
}
.box p{
    color:#424242;
}

    </style>
</head>
<body>
  <?php include "/header/header-body.php"; ?>
  <div class="container">
  <h1>HawkLot</h1>
  <p>A parking-space sharing service.</p>
  <p>This year, the parking lot rules at Maine South changed so that specific spots are reserved for the entire year. But, nobody users his/her spot every day--there are days when a substantial portion of the parking lot sits empty. This is an inefficient system, and an unfair system for those who were not able to get a parking pass.</p>
  <p>Our idea is for a park-share program, in which the owners of parking spaces can “rent” them out for the day if they don’t plan to use it. </p>
  <a href="register.php" class="btn btn-default" role="button">Sign Up!</a>
  <br><br><br><br><br><br><p align="center">©2016 Inflatus Games</p>
  </div>
  <div class="overlay" id="overlay" style="display:none;"></div>

  <div class="box" id="box">
   <button class="close" id="boxclose"></button>
   <h1 align="center">Welcome to HawkLot!</h1>
   <p align="center">
    This is a test. Press the close button.
   </p>
  </div>
  <a href="" id="activator">activator</a>
<script>
$(function() {
    $('#activator').click(function(){
        $('#overlay').fadeIn(200,function(){
            $('#box').animate({'top':'40%'},200);
        });
        return false;
    });
    $('#boxclose').click(function(){
        $('#box').animate({'top':'-200px'},500,function(){
            $('#overlay').fadeOut('fast');
        });
    });
    $('#overlay').click(function(){
        $('#box').animate({'top':'-200px'},500,function(){
            $('#overlay').fadeOut('fast');
        });
    });

});
</script>


</body>
</html>
