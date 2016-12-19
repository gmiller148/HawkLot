  <?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  if(!isset($_SESSION['logon']))
  {
    $_SESSION['logon'] = 0;
  }
  if(!isset($_SESSION['money']))
  {
    $_SESSION['money'] = -1;
  }
  include "userdbsetup.php";
  if(isset($_POST['email']) && isset($_POST['password'])){
    $username = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);
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
        $usr_money_query = "SELECT moneys FROM users where username='$username'";
        $usr_money = mysqli_query($conn, $usr_money_query);
        $row = mysqli_fetch_assoc($usr_money);
        $_SESSION['money'] = $row['moneys'];
        $event = "INSERT INTO mastertable(action, user, actiontime) VALUES('login', '$username', CURRENT_TIMESTAMP)";
        $run_event = mysqli_query($conn, $event);
        switch($_SESSION['logon']){
          case 1:
          $usr_renter_query = "SELECT carmodel FROM renters where email='$username'";
          $usr_rentable = mysqli_query($conn, $usr_renter_query);
          $check_rentable = mysqli_num_rows($usr_rentable);
          if(!($check_rentable > 0)) {
            $login_dest="register-renter.php?src=nV";
          }
          break;
          case 2:
          $usr_renter_query = "SELECT verified FROM owners where email='$username'";
          $usr_rentable = mysqli_query($conn, $usr_renter_query);
          $check_rentable = mysqli_num_rows($usr_rentable);
          if(!($check_rentable > 0)) {
            $login_dest="register-spot.php?src=nV";
          break;
          }
        }
      }
    }
  }

  if((isset($_POST['login_HEADER']) || isset($_POST['login_PAGE'])) && !isset($login_dest)) {
      switch ($_SESSION['logon']) {
        case 3:
          $login_dest = 'admin.php';
          break;
        case 2:
          $login_dest = 'owner.php';
          break;
        case 1:
          $login_dest = 'user.php';
          break;
        default:
          $login_dest = "index.php?src=login_fail";
    }
  }
  /*$to      = 'rprendergast180@s207.org';
  $subject = 'Welcome to HawkLot!';
  $message = '

    Thank you for signing up for HawkLot!!!

    Please click this link to login to your account:
    http://localhost:8080/login_page.php

  ';
  $headers = 'From:r.prendergast@hawklot.com' . "\r\n";
  mail($to, $subject, $message, $headers);
*/

  mysqli_close($conn);

  echo '<meta http-equiv="refresh" content="0;url='.$login_dest.'">';
  ?>
