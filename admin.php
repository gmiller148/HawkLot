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
<?php if($_SESSION['logon']==3) {
  include "header.php";
  $_SESSION[logged_on_visiting]=true;
  echo "Hello admin: ".$_SESSION['username'];
  exit;
  }
?>

</body>
</html>

<?php session_destroy(); ?>
