<?php
  session_start();
  if($_SESSION['logon']<3) {
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
<?php if($_SESSION['logon']==3) : ?>
  <?php
    include "header.php";
    $_SESSION[logged_on_visiting]=true;
    echo "Hello user: ".$_SESSION['username'];
    echo $_SESSION['logon'];
    echo $_SESSION['reroute'];
    echo $_SESSION['logged_on_visiting'];
  ?>
  <form action="reroute.php" method="post">
    <input type="submit" name="logout" value="Logout">
    <?php exit; ?>
  </form>
<?php endif; ?>
</body>
</html>

<?php session_destroy(); ?>
