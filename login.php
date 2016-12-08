<!DOCTYPE html>
<html>
<body>
  <?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  if(!isset($_SESSION['logon']))
  {
    $_SESSION['logon'] = 0;
  }
  if(isset($_POST['login'])) {
    include "userdbsetup.php";
    $username = mysqli_real_escape_string($conn,$_POST['email']);
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

        $event = "INSERT INTO mastertable(action, user, actiontime) VALUES('login', '$username', CURRENT_TIMESTAMP)";
        $run_event = mysqli_query($conn, $event);
      }
    }
    mysqli_close($conn);
  }
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
  echo '<meta http-equiv="refresh" content="0;url='.$login_dest.'">';
  ?>


</body>
</html>
