<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>HawkLot</title>
</head>
<body style="background-color:cyan;">
  <?php include "header.php"; ?>
  <div class="container">
  <h1>HawkLot</h1>
  <p>A parking-space sharing service.</p>
  <p>This year, the parking lot rules at Maine South changed so that specific spots are reserved for the entire year. But, nobody users his/her spot every day--there are days when a substantial portion of the parking lot sits empty. This is an inefficient system, and an unfair system for those who were not able to get a parking pass.</p>
  <p>Our idea is for a park-share program, in which the owners of parking spaces can “rent” them out for the day if they don’t plan to use it. </p>
  </div>
  <div class="row">
    <div class="col-xs-4">boi</div>
  </div>
    <?php
    #  unset($_POST['username']);
      if(!isset($_SESSION['logged_on_visiting'])){
      $_SESSION['logged_on_visiting'] = false;
    } ?>
    <?php if(!$_SESSION['logged_on_visiting']) : ?>
    <form action="index.php" method="post" class="login_form">
      <div class="row">
        <div class="col-md-2 col-md-offset-5">
          <h2>User Login</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-5">
          <b>Username:</b>
          <input type="text" name="user" required="required">
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-5">
          <b>Password:</b>
          <input type="password" name="pass" required="required">
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-5">
          <br>
          <input class="btn btn-primary" type="submit" name="login" value="Submit">
        </div>
      </div>

        <?php
        if(isset($_POST['login'])) {
          include "userdbsetup.php";
          $username = mysqli_real_escape_string($conn,$_POST['user']);
          $pass = mysqli_real_escape_string($conn,$_POST['pass']);
          $sel_user_query = "SELECT * FROM users WHERE username='$username'";
          $run_user = mysqli_query($conn, $sel_user_query);
          $check_user = mysqli_num_rows($run_user);

          if($check_user > 0) {
            $row = mysqli_fetch_assoc($run_user);
            $pw = $row['pass'];

            if(password_verify($pass, $pw)) {
              $_SESSION['username'] = $username;
              $usr_privlg_query = "SELECT privelege FROM users where username='$username'";
              $usr_privlg = mysqli_query($conn, $usr_privlg_query);
              $row = mysqli_fetch_assoc($usr_privlg);
              $_SESSION['logon'] = $row['privelege'];
              $_SESSION['logged_on_visiting'] = false;
            }else {
              echo "<script>alert('Email or password is not correct, try again')</script>";
            }
          }
        }
        mysqli_close($conn);
        ?>
    </form>
    <?php endif; ?>
    <br><br><br><br><br><br><p align="center">©2016 Inflatus Games</p>

    <?php if($_SESSION['logon']>0 and $_SESSION['logged_on_visiting']==false) : ?>
      <?php
        switch ($_SESSION['logon']) {
          case 3:
            $login_dest = 'admin.php';
            break;
          case 2:
            $login_dest = 'renter.php';
            break;
          case 1:
            $login_dest = 'user.php';
        }
        echo '<meta http-equiv="refresh" content="0;url='.$login_dest.'">'; ?>
    <?php endif; ?>

</body>
</html>
