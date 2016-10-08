<?php
  session_start();
  echo $_SESSION['logon'];
  if($_SESSION['logon']!="admin") {
  header("refresh:0; url=index.php");
  echo "USER IS NOT LOGGED ON";
  echo $_SESSION['username'];
  exit;
}
?>


<html>
<body>
<?php if($_SESSION['logon']=="admin") : ?>
  <?php echo "Hello user: ".$_SESSION['username']; ?>
  <form action="reroute.php" method="post">
    <?php $_SESSION['reroute'] = "index.php"; ?>
    <input type="submit" name="logout" value="Logout">
    <?php exit; ?>
  </form>
<?php endif; ?>
</body>
</html>

<?php session_destroy(); ?>
