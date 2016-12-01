<?php
  session_start();
  if($_SESSION['logon']<2) {
    header("refresh:1; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
  if($_SESSION['logon']>=2) {
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
    <link rel="stylesheet" href="style/register-spot.css">
	</head>
  <body style="background-attachment: fixed">
  <?php if($_SESSION['logon'] >=2) : ?>

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

                $get_id = "SELECT id FROM users WHERE username='$email'";
                $run_id = mysqli_query($conn, $get_id);
                $id = -1;

                if (mysqli_num_rows($run_id) > 0) {
    // output data of each row
                  while($row = mysqli_fetch_assoc($run_id)) {
                    $id = $row["id"];
                    echo "<script>alert('You're name or email is incorrect)</script>";
                  }
                }

                if($check_user == 0) {
                  echo "<script>alert('You're name or email is incorrect)</script>";
                }
                else if($check_user == 1) {
                  $query = "INSERT INTO owners(id, email, spotnumber,verified,licenseplate) VALUES('$id', '$email', '$spotnumber', '0', '$licenseplate')";
                  $run_query = mysqli_query($conn, $query);
                  echo '<meta http-equiv="refresh" content="0;url=owner.php">';
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
