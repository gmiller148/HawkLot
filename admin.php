<?php

if(!session_id()){
  session_start();
}
if(!$_SESSION['logon']){
  header("Location:index.php");
}

?>
