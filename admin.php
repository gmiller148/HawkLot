<?php
  session_start();
  if($_SESSION['logon']!="admin") {
    header("refresh:0; url=index.php");
    echo "USER IS NOT LOGGED ON";
  exit;
}
?>

<html>
<head>
  <title>Admin Page</title>
</head>
<body style="background-color:cyan;">
<?php if($_SESSION['logon']=="admin") : ?>
  <?php
    include "header.php";
    echo "Hello user: ".$_SESSION['username'];
    echo $_SESSION['logon'];
    echo $_SESSION['reroute'];
    unset($_SESSION['reroute']);
  ?>
  <form action="reroute.php" method="post">
    <input type="submit" name="logout" value="Logout">
    <?php exit; ?>
  </form>
<?php endif; ?>
</body>
</html>

<?php session_destroy(); ?>
