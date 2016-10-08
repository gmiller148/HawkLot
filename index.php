<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>HawkLot</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">

</head>
<body style="background-color:cyan;">
  <ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="register.php">Register</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn" onclick="myFunction()">More</a>
      <div class="dropdown-content" id="myDropdown">
        <a href="aboutus.php">About Us</a>
        <a href="ourstory.php">Our Story</a>
      </div>
    </li>
  </ul>

  <h1>HawkLot</h1>
  <p>A parking-space sharing service.</p>
  <p>This year, the parking lot rules at Maine South changed so that specific spots are reserved for the entire year. But, nobody users his/her spot every day--there are days when a substantial portion of the parking lot sits empty. This is an inefficient system, and an unfair system for those who were not able to get a parking pass.</p>
  <p>Our idea is for a park-share program, in which the owners of parking spaces can “rent” them out for the day if they don’t plan to use it. </p>

  <script>
  /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
  function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {

      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var d = 0; d < dropdowns.length; d++) {
        var openDropdown = dropdowns[d];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  </script>


    <form action="index.php" method="post" class="login_form">
      <table width="500" align="center" >
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

          $username = mysqli_real_escape_string($conn,$_POST['user']);
          $pass = mysqli_real_escape_string($conn,$_POST['pass']);
          $sel_user = "SELECT * FROM users WHERE username='$username'";
          $run_user = mysqli_query($conn, $sel_user);
          $check_user = mysqli_num_rows($run_user);

          if($check_user > 0) {
            $row = mysqli_fetch_assoc($run_user);
            $pw = $row['pass'];

            if(password_verify($pass, $pw)) {
              session_start();
              $_SESSION['username'] = $username;
              $_SESSION['logon'] = "admin";
            }else {
            echo "<script>alert('Email or password is not correct, try again')</script>";
            }
          }
        }
        mysqli_close($conn);
        ?>
    </form>
    <?php if($_SESSION['logon']) : ?>
      <meta http-equiv="refresh" content="0;url=admin.php">
    <?php endif; ?>

</body>
</html>
