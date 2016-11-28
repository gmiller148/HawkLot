<html>
<body>
<?php
session_start();
echo "Please wait while we reroute you to ";
if(isset($_SESSION['reroute'])){
  echo "{$_SESSION['reroute']}";
  echo '<meta http-equiv="refresh" content="0;url='.$_SESSION['reroute'].'">';
}
else{
  echo "index.php";
  if (isset($_GET['logout'])) {
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
