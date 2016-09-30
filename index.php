<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HawkLot</title>
</head>
<body>
    <h1>HawkLot</h1>
    <p>A parking-space sharing service.</p>
    <p>This year, the parking lot rules at Maine South changed so that specific spots are reserved for the entire year. But, nobody users his/her spot every day--there are days when a substantial portion of the parking lot sits empty. This is an inefficient system, and an unfair system for those who were not able to get a parking pass.</p>
    <p>Our idea is for a park-share program, in which the owners of parking spaces can “rent” them out for the day if they don’t plan to use it. </p>
    <form action="index.php" method="post">
      <table width="500" align="center">
        <tr align="right">
          <td colspan=”3″>
            <h2>User Login</h2>
          </td>
        </tr>
        <tr>
          <td align="right">
            <b>Username:</b>
          </td>
          <td>
            <input type="text" name="user" required="required">
          </td>
        </tr>
        <tr>
          <td align="right"><b>Password:</b></td>
          <td><input type="password" name="pass" required="required"></td>
        </tr>
        <tr>
          <td colspan="3" align="center">
            <input type="submit" name="login" value="Submit">
          </td>
        </tr>
        <tr>
          <td align="center">
            <a href="register.php">Register Now</a>
        </tr>
      </table>
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
          $sel_user = "SELECT * FROM users WHERE username='$username'";
          $run_user = mysqli_query($conn, $sel_user);
          $check_user = mysqli_num_rows($run_user);

      #    printf("Result set has %d rows.\n", $check_user);

          if($check_user > 0) {
            $row = mysqli_fetch_assoc($run_user);
            $pw = $row['pass'];
            
            if(password_verify($pass, $pw)) {

              session_start();

              $_SESSION['username'] = $username;
        #    echo "eyeyeyeyeye";
        #    echo session_id();
              #header("Location: admin.php");
            #if(isset($username) && isset($password)){
        #      echo 'wassaas';
              $_SESSION['logon'] = true;
        #      echo $_SESSION['logon'];
              #header('location: admin.php');
          #  }
        #    echo 'USER FOUND';

          }
          else {
            echo "<script>alert('Email or password is not correct, try again')</script>";
          }
        }


        }



        /*$sql = "INSERT INTO users (user_id,user_password) VALUES ('$user','$password')";
        if (mysqli_query($conn, $sql)) {
          echo "it worked";
        } else {
          echo "did not work. error: " . mysqli_error($conn);
        }
        */
        mysqli_close($conn);
        ?>
    </form>

</body>
</html>
