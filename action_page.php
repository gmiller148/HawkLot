<html>
<body>
  <?php ?>
    <?php
    $db = 'UserDB';
    $conn = mysqli_connect("localhost:8889", "root", "root");
// Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, $db);

    if(isset($_POST['login'])) {

      $username = $_POST['user'];
      $pass = $_POST['pass'];
      $sel_user = "SELECT * FROM users WHERE user_id='$username' AND user_password='$pass'";
      $run_user = mysqli_query($conn, $sel_user);
      //$check_user = mysqli_num_rows($run_user);

      $check_user = mysqli_num_rows($run_user);

      printf("Result set has %d rows.\n", $check_user);

      if($check_user > 0) {
        $_SESSION['user_id'] = $username;
        echo 'USER FOUND';
      }
      else {
        echo "no";
        //echo "<script>alert('Email or password is not correct, try again')</script>";
      }

    } else { echo 'this didnt ran';}



    /*$sql = "INSERT INTO users (user_id,user_password) VALUES ('$user','$password')";
    if (mysqli_query($conn, $sql)) {
      echo "it worked";
    } else {
      echo "did not work. error: " . mysqli_error($conn);
    }
    */
    mysqli_close($conn);



    /*$user = 'root';
    $password = 'root';
    $db = 'tutorial';
    $host = 'localhost';
    $port = 8889;

    $link = mysqli_init();
    $success = mysqli_real_connect(
       $link,
       $host,
       $user,
       $password,
       $db,
       $port
    );
    echo($success);

    $sql = "CREATE DATABASE myDB";

    /*if(mysqli_query($success, $sql))

     echo "Suc";
    } else {
      echo "WTF : " . mysqli_error($success);
    }

    /*if (mysql_query($link, $sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $link->error;
    }



    /*$db_selected = mysql_select_db(
        $db,
        $link
    );
    @mysql_select_db($db) or die("SCAMMM");

    mysql_close();
    mysql_close();
    /*$i=0;while($i<$num){
      CODE$i++;
    }*/





    /*$sql = "INSERT INTO Names (Name) VALUES ('scam')";

    $if(mysql_query($link, $sql)) {
      echo "Data entered";
    } else {
      echo "Failed";
    }*/

    ?>
</body>
</html>
