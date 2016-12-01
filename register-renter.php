
<?php
  session_start();
  if($_SESSION['logon']<1) {
    header("refresh:1; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
  if($_SESSION['logon']>=1) {
    include "header.php";
  }
?>
<!--Things to do:
-Make and Model of the car into database
-->

<html>
  <head>
		<title>Register Your Spot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
    <style>
    body, html{
         height: 100%;
     	background-repeat: repeat;


     	background-color: #d3d3d3;
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

    </style>
	</head>
  <body style="background-attachment: fixed">
  <?php if($_SESSION['logon'] >=2) : ?>

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

            <?php
              include("dbconnect.php");
              if(isset($_POST['register'])) {


                $email = mysqli_real_escape_string($conn, $_SESSION['username']);
                $carmodel = mysqli_real_escape_string($conn, $_POST['cartype']);
                echo "<script>alert('$carmodel')</script>";
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

                $get_id = "SELECT id FROM users WHERE username='$email'";
                $run_id = mysqli_query($conn, $get_id);
                $id = -1;


                if (mysqli_num_rows($run_id) > 0) {
    // output data of each row
                  while($row = mysqli_fetch_assoc($run_id)) {
                    $id = $row["id"];

                  }
                }

                if($check_user == 0) {
                  echo "<script>alert('You're name or email is incorrect)</script>";
                }
                else if($check_user == 1) {

                  $query = "INSERT INTO renters(id, email, carmodel,carcolor,licenseplate) VALUES('$id', '$email', '$carmodel', '$carcolor', '$licenseplate')";
                  $run_query = mysqli_query($conn, $query);
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

              </script>

					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>


<?php endif;?>
	</body>
</html>
