<html>
<body>
<?php
include "userdbsetup.php";
session_start();
echo "Please wait while we reroute you to ";
if(isset($_SESSION['reroute'])){
  echo "{$_SESSION['reroute']}";
  echo '<meta http-equiv="refresh" content="0;url='.$_SESSION['reroute'].'">';
}
else{
  echo "index.php";
  if (isset($_GET['logout'])) {
    $username = $_SESSION['username'];
    $event = "INSERT INTO mastertable(action, user, actiontime) VALUES('logout', '$username', CURRENT_TIMESTAMP)";
    $run_event = mysqli_query($conn, $event);
    unset($_SESSION['money']);
    unset($_SESSION['logon']);
    unset($_SESSION['username']);
    unset($_SESSION['logged_on_visiting']);
    session_destroy();
  }
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
  exit;
}
?>
</body>
</html>
