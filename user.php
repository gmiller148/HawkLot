<?php
  session_start();
  if($_SESSION['logon']!="admin") {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
  exit;
}
?>

<html>
<body>
  <?php if($_SESSION['logon']=="admin") {
      include "header.php";
      echo "Hello user: ".$_SESSION['username'];
    }
    ?>
</html>
</body>
