<html>
<body style="background-color:cyan;">
  <?php include "header.php"; ?>
  <form action="register.php" method=POST>
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
        <td align="right"><b>Password Again:</b></td>
        <td><input type="password" name="pass_check" required="required"></td>
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

      if($check_user == 0) {
        $new_user = "INSERT INTO users(username, pass) VALUES('$username', '$hashAndSalt')";
        $create_user = mysqli_query($conn, $new_user);
        echo "<script>alert('User was successfully created')</script>";
        mysqli_close($conn);
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
        exit;
      }
      else {
        echo "<script>alert('$username is already taken, try again')</script>";
      }
    }
    mysqli_close($conn);
    ?>

  </form>
</body>
</html>
