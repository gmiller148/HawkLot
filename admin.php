<?php if($_SESSION['logon']!=4) {
  session_start();
  header("refresh:3; url=index.php");
  echo "PLEASE LOG ON."."\n";
  echo $_SESSION['logon']. "\n";
  echo session_id();
  echo $_SESSION['username']. "\n";
  exit;
}
?>


<html>
<body>
  <p>Redirecting you in 3 seconds...</p>
<?php if($_SESSION['logon']==4) : ?>
  <p>This is a hidden element</p>
  <?php echo $_SESSION['username']; ?>
<?php endif; ?>
</body>
</html>
