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
  echo '<meta http-equiv="refresh" content="0;url=index.php">';
}
session_destroy();
?>

</body>
</html>
