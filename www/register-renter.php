<?php
  include "/header/header-control.php";
  if($_SESSION['logon']<1) {
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
		<title>Register Your Car</title>
    <?php
        if($_SESSION['logon']==1 || $_SESSION['logon']==3) {
        include "/header/header-head.php";
      }
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
    <style>
    body, html{
     	background-repeat: repeat;
    }

    h1.title {
    	font-size: 50px;
    	font-weight: 400;
    }

    hr{
    	width: 10%;
    	color: #fff;
    }

    .form-group{
    	margin-bottom: 15px;
    }

    label{
    	margin-bottom: 15px;
    }

    input,
    input::-webkit-input-placeholder {
        font-size: 11px;
        padding-top: 3px;
    }

    .main-login{
     	background-color: #fff;
        /* shadows and rounded borders */
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

    }

    .main-center{
     	margin-top: 30px;
     	margin: 0 auto;
     	max-width: 330px;
        padding: 30px 30px;

    }

    .login-button{
    	margin-top: 5px;
    }

    .login-register{
    	font-size: 11px;
    	text-align: center;
    }

    @import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css')
      .funkyradio div {
       clear: both;
       overflow: hidden;
      }
      .funkyradio label {
       width: 100%;
       border-radius: 3px;
       border: 1px solid #D1D3D4;
       font-weight: normal;
      }
      .funkyradio input[type="radio"]:empty,
      .funkyradio input[type="checkbox"]:empty {
       display: none;
      }
      .funkyradio input[type="radio"]:empty ~ label,
      .funkyradio input[type="checkbox"]:empty ~ label {
       position: relative;
       line-height: 2.5em;
       text-indent: 3.25em;
       cursor: pointer;
       -webkit-user-select: none;
          -moz-user-select: none;
           -ms-user-select: none;
               user-select: none;
      }
      .funkyradio input[type="radio"]:empty ~ label:before,
      .funkyradio input[type="checkbox"]:empty ~ label:before {
       position: absolute;
       display: block;
       top: 0;
       bottom: 0;
       left: 0;
       content: '';
       width: 2.5em;
       background: #D1D3D4;
       border-radius: 3px 0 0 3px;
      }
      .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
      .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
       color: #888;
      }
      .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
      .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
       content: '\2714';
       text-indent: .9em;
       color: #C2C2C2;
      }
      .funkyradio input[type="radio"]:checked ~ label,
      .funkyradio input[type="checkbox"]:checked ~ label {
       color: #777;
      }
      .funkyradio input[type="radio"]:checked ~ label:before,
      .funkyradio input[type="checkbox"]:checked ~ label:before {
       content: '\2714';
       text-indent: .9em;
       color: #333;
       background-color: #ccc;
      }
      .funkyradio input[type="radio"]:focus ~ label:before,
      .funkyradio input[type="checkbox"]:focus ~ label:before {
       box-shadow: 0 0 0 3px #999;
      }
      .funkyradio-default input[type="radio"]:checked ~ label:before,
      .funkyradio-default input[type="checkbox"]:checked ~ label:before {
       color: #333;
       background-color: #ccc;
      }
      .funkyradio-primary input[type="radio"]:checked ~ label:before,
      .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #337ab7;
      }
      .funkyradio-success input[type="radio"]:checked ~ label:before,
      .funkyradio-success input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #5cb85c;
      }
      .funkyradio-danger input[type="radio"]:checked ~ label:before,
      .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #d9534f;
      }
      .funkyradio-warning input[type="radio"]:checked ~ label:before,
      .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #f0ad4e;
      }
      .funkyradio-info input[type="radio"]:checked ~ label:before,
      .funkyradio-info input[type="checkbox"]:checked ~ label:before {
       color: #fff;
       background-color: #5bc0de;
      }
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



    </style>
	</head>
  <body style="background-attachment: fixed">
  <?php if($_SESSION['logon'] ==1 || $_SESSION['logon'] ==3) : ?>
    <?php
        if($_SESSION['logon']==1 || $_SESSION['logon']==3) {
        include "/header/header-body.php";
      }
    ?>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	      </div>
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="register-renter.php">


						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Car Make and Model</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="cartype" id="cartype"  placeholder="Enter your Car Make and Model" required="required"/>
								</div>
							</div>
						</div>


          	<div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Car Color</label>
    						<div class="cols-sm-10">
                  <div class="input-group">
            				<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right fa" aria-hidden="true"></i></span>
            				<input type="text" class="form-control" name="carcolor" id="carcolor"  placeholder="Enter your Car Color" required="required"/>
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
                Congratulations! You have successfully registered as a renter!<br><br>
                Before you can continue, we need you to register the car you will drive.<br><br>
                This helps Maine South ensure the correct renters park in the correct spots.
               </p>
             </div><br>
              <button id="activator" class="btn btn-success btn-sm">Click to see the information popup</button>
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
                $carmodel = mysqli_real_escape_string($conn, $_POST['cartype']);
                $carcolor = mysqli_real_escape_string($conn, $_POST['carcolor']);
                $licenseplate = mysqli_real_escape_string($conn, $_POST['licenseplate']);
                $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);

                if($licenseplate != $confirm) {

                  mysqli_close($conn);
                  exit;
                }

                $sel_user = "SELECT * FROM users WHERE username='$email'";
                $run_user = mysqli_query($conn, $sel_user);
                $check_user = mysqli_num_rows($run_user);

                $get_id = "SELECT id, studentid FROM users WHERE username='$email'";
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
                elseif($check_user == 1) {

                  $query = "INSERT INTO renters(id, email, carmodel,carcolor,licenseplate, studentid) VALUES('$id', '$email', '$carmodel', '$carcolor', '$licenseplate', '$studentid')";
                  $run_query = mysqli_query($conn, $query);
                  $event = "INSERT INTO mastertable(action, user, actiontime) VALUES('car_registered', '$email', CURRENT_TIMESTAMP)";
                  $run_event = mysqli_query($conn, $event);
                  echo '<meta http-equiv="refresh" content="0;url=user.php">';
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

<?php endif;?>
	</body>
</html>
