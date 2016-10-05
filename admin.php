<?php
  session_start();
  echo $_SESSION['logon'];
  if($_SESSION['logon']!="admin") {
  header("refresh:0.01; url=index.php");
  echo "PTFO OR GTFO";
  echo $_SESSION['username'];
  exit;
}
?>


<html>
<body>
  <p>Redirecting you in 3 seconds...</p>
<?php if($_SESSION['logon']=="admin") : ?>
  <?php echo "Hello user: ".$_SESSION['username']; ?>
  <form action="logout.php" method="post">
    <input type="submit" name="logout" value="Logout">
  </form>
<?php endif; ?>
</body>
</html>

<?php session_destroy(); ?>
