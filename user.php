<?php
  session_start();
  if($_SESSION['logon']<1) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
    session_destroy();
    exit;
  }
?>

<html>
<body>
  <?php if($_SESSION['logon']>=1) {
      include "header.php";
      echo "Hello user: ".$_SESSION['username'];
    }
    ?>
</html>
</body>
