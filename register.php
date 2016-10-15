
<html>
<head>
  <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:cyan;">
  <?php include "header.php"; ?>
  <form action="register.php" method=POST>
    <table width="500" align="center">
      <tr align="right">
        <td colspan=”3″>
          <h2>User Register</h2>
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
        <td align="right"><b>Password Again:</b></td>
        <td><input type="password" name="pass_check" required="required"></td>
      </tr>
      <tr>
        <td colspan="3" align="left">
          <div class="btn-group btn-group-vertical" datatoggle="buttons">
            <label class="btn btn-primary active">
              <input type="radio" autocomplete="off" name="access" value="renter" checked><span>I want to rent parking spots.</span>
            </label>
            <label class="btn">
              <input type="radio" autocomplete="off" name="access" value="renter"><span>I own a parking spot.</span>
            </label>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3" align="center">
          <input type="submit" name="register" value="Register">
        </td>
      </tr>

    </table>

    <?
    $db = 'UserDB';
    $conn = mysqli_connect("localhost:8889", "root", "root");
// Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_select_db($conn, $db);
    if(isset($_POST['register'])) {
      $username = mysqli_real_escape_string($conn,$_POST['user']);
      $pass = mysqli_real_escape_string($conn,$_POST['pass']);
      $pass_check = $_POST['pass_check'];
      if($pass != $pass_check) {
        echo "<script>alert('Passwords are not the same')</script>";
        mysqli_close($conn);
        exit;
      }
      $hashAndSalt = password_hash($pass, PASSWORD_BCRYPT);
      $sel_user = "SELECT * FROM users WHERE username='$username'";
      $run_user = mysqli_query($conn, $sel_user);
      $check_user = mysqli_num_rows($run_user);
      $level_of_access = $_POST['access'];
      $priv = -1;
      if($level_of_access == 'renter') {
        $priv = 1;
      } else if($level_of_access == 'owner') {
        $priv = 2;
      }
      //1 = renter :: 2 = owner :: 3 = admin
      if($check_user == 0) {
        $new_user = "INSERT INTO users(username, pass, privelege) VALUES('$username', '$hashAndSalt', '$priv')";
        $create_user = mysqli_query($conn, $new_user);
        echo "<script>alert('User was successfully created')</script>";
        mysqli_close($conn);
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
        exit;
      }
      //COMMENT TEST
      else {
        echo "<script>alert('$username is already taken, try again')</script>";
      }

    }
    mysqli_close($conn);
    ?>

  </form>
</body>
</html>
