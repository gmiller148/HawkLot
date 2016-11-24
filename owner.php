<?php
  session_start();
  if($_SESSION['logon']<2) {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
  exit;
}
?>

<html>
<body>
  <?php if($_SESSION['logon']>=2) {
      include "header.php";
      echo "Hello renter: ".$_SESSION['username'];
    }
    ?>

        <div class="container">
          <div class="row main">
            <h1><a href="register-spot.php">Need to register a spot?</a></h1>
          </div>
        </div>

</html>
</body>
