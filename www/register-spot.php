<?php
  include "header/header-control.php";
  if($_SESSION['logon']<2) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
?>
<!--Things to do:
-Make and Model of the car into database
-->

<html>
  <head>
		<title>Register Your Spot</title>
    <?php if($_SESSION['logon'] >= 2) {
      include "/header/header-head.php";
    } ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="style/register-spot.css">
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
    left:30%;
    right:30%;
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
    @media(max-width:768px){
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
    .spot_owned{
      color:#ff0000;
    }


    </style>
	</head>
  <body style="background-attachment: fixed">
  <?php if($_SESSION['logon'] >=2) : ?>
  <?php if($_SESSION['logon'] >= 2) {
    include "/header/header-body.php";
  } ?>

		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	      </div>
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="register-spot.php">
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Spot Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right fa" aria-hidden="true"></i></span>
									<input type="number" class="form-control" name="spotnumber" id="spotnumber"  placeholder="Enter your Spot Number" required="required"/>
								</div>
							</div>
						</div>


						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">License Plate Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="licenseplate" id="licenseplate"  placeholder="Enter your License Plate Number" required="required"/>
								</div>
							</div>
						</div>

            <div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Confirm License Plate Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="confirm" id="confirm"  placeholder="Enter your License Plate Number again" required="required"/>
								</div>
							</div>
						</div>

            <div class="form-group">

							<div class="cols-sm-10">
								<div id="pwdWarning" align="center">
                  <br>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<button type="sumbit" name="register" id="submit" class="btn btn-primary btn-lg btn-block login-button" action="login.php">Register</button>
						</div>
            <?php if(isset($_GET['src'])) : ?>
            <?php if($_GET['src']=='nV') : ?>
              <div class="overlay" id="overlay" style="display:none;"></div>
              <div class="box" id="box">
               <button class="close" id="boxclose"></button>
               <h1 align="center">Welcome to HawkLot!</h1>
               <br><p>
                Congratulations! You have successfully registered as a spot owner!<br><br>
                Before you can continue, we need you to register the specific parking spot you own.<br><br>
                This will be verified with Maine South's databases.
               </p>
             </div><br>
              <a href="" id="activator">Click to see the information popup</a>
              <script>
                $(function() {
                    $('#activator').click(function(){
                        $('#overlay').fadeIn(200,function(){
                            $('#box').animate({'top':'25%'},200);
                        });
                        return false;
                    });
                    $('#boxclose').click(function(){
                        $('#box').animate({'top':'-400px'},500,function(){
                            $('#overlay').fadeOut('fast');
                        });
                    });
                    $('#overlay').click(function(){
                        $('#box').animate({'top':'-400px'},500,function(){
                            $('#overlay').fadeOut('fast');
                        });
                    });
                });

            </script>
            <?php endif; ?>
            <?php endif; ?>

            <?php
              include("dbconnect.php");
              if(isset($_POST['register'])) {
                $email = mysqli_real_escape_string($conn, $_SESSION['username']);
                $spotnumber = mysqli_real_escape_string($conn, $_POST['spotnumber']);
                $licenseplate = mysqli_real_escape_string($conn, $_POST['licenseplate']);
                $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);
                if($licenseplate != $confirm) {
                  mysqli_close($conn);
                  exit;
                }
                $sel_user = "SELECT * FROM users WHERE username='$email'";
                $run_user = mysqli_query($conn, $sel_user);
                $check_user = mysqli_num_rows($run_user);

                $get_id = "SELECT id,studentid FROM users WHERE username='$email'";
                $run_id = mysqli_query($conn, $get_id);
                $id = -1;
                $studentid = -1;
                if (mysqli_num_rows($run_id) > 0) {
                  while($row = mysqli_fetch_assoc($run_id)) {
                    $id = $row["id"];
                    $studentid = $row["studentid"];
                  }
                }

                if($check_user == 0) {
                  echo "<script>alert('You're name or email is incorrect)</script>";
                }
                else if($check_user == 1) {
                  $owned_already_query = "SELECT email FROM owners WHERE spotnumber='$spotnumber'";
                  $run_owned_already = mysqli_query($conn, $owned_already_query);
                  if(mysqli_num_rows($run_owned_already) == 0 ){
                    $query = "INSERT INTO owners(id, email, spotnumber,verified,licenseplate, studentid) VALUES('$id', '$email', '$spotnumber', '1', '$licenseplate', '$studentid')";
                    $run_query = mysqli_query($conn, $query);
                    $_POST['owner'] = $email;
                    $_POST['id'] = $spotnumber;
                    include "json_edit.php";
                    $event = "INSERT INTO mastertable(action, user, actiontime) VALUES('spot_registered', '$email', CURRENT_TIMESTAMP)";
                    $run_event = mysqli_query($conn, $event);
                    echo '<script>alert("You have successfully registered spot number '.$spotnumber.' and it has been automatically verified.")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=owner.php">';
                  }else{
                    echo '<div class="spot_owned" align="center">ERROR: This spot is already owned</div>';
                  }
                  #$new_user = "INSERT INTO users(username, pass, privelege) VALUES('$email', '$hashAndSalt', '$priv')";
                  #$create_user = mysqli_query($conn, $new_user);
                  #mysqli_close($conn);
                  #echo "<script>alert('User was successfully created')</script>";
                  #echo '<meta http-equiv="refresh" content="0;url=index.php">';
                  #exit;
                } else {
                  echo "<script>alert('ERROR! Please quit the site.')</script>";
                }



              }
              ?>
              <script>
                function checkPasswordMatch() {
                  var password = $("#licenseplate").val();
                  var confirmPassword = $("#confirm").val();

                  if (password != confirmPassword) {
                    $("#pwdWarning").html("License plate numbers do not match!").css('color', 'red');
                     $("#submit").attr("disabled","disabled");
                  } else {
                    $("#pwdWarning").html("<br>").css('color', 'red');
                    $("#submit").removeAttr('disabled');
                  }
                }
                  $(document).ready(function () {
                    $("#confirm").keyup(checkPasswordMatch);
                  });

                  $('form').submit(function(){
                    var required = $('[required="required"]');
                    var error = false;

                    for(var i = 0; i <= (required.length - 1);i++)
                    {
                      if(required[i].value == '')
                      {
                        required[i].style.backgroundColor = 'rgb(255,155,155)';
                        error = true;
                      }
                    }
                    if(error)
                    {
                      return false;
                    }
                    });


              </script>

					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>


<?php endif;?>
	</body>
</html>
