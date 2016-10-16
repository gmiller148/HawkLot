<html>
<head>
  <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
<style>
  @import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css')
    .funkyradio div {
     clear: both;
     overflow: hidden;
    }
    .funkyradio label {
     width: 100%;
     border-radius: 3px;
     border: 1px solid #D1D3D4;
     font-weight: normal;
    }
    .funkyradio input[type="radio"]:empty,
    .funkyradio input[type="checkbox"]:empty {
     display: none;
    }
    .funkyradio input[type="radio"]:empty ~ label,
    .funkyradio input[type="checkbox"]:empty ~ label {
     position: relative;
     line-height: 2.5em;
     text-indent: 3.25em;
     margin-top: 2em;
     cursor: pointer;
     -webkit-user-select: none;
        -moz-user-select: none;
         -ms-user-select: none;
             user-select: none;
    }
    .funkyradio input[type="radio"]:empty ~ label:before,
    .funkyradio input[type="checkbox"]:empty ~ label:before {
     position: absolute;
     display: block;
     top: 0;
     bottom: 0;
     left: 0;
     content: '';
     width: 2.5em;
     background: #D1D3D4;
     border-radius: 3px 0 0 3px;
    }
    .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
    .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
     color: #888;
    }
    .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
    .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
     content: '\2714';
     text-indent: .9em;
     color: #C2C2C2;
    }
    .funkyradio input[type="radio"]:checked ~ label,
    .funkyradio input[type="checkbox"]:checked ~ label {
     color: #777;
    }
    .funkyradio input[type="radio"]:checked ~ label:before,
    .funkyradio input[type="checkbox"]:checked ~ label:before {
     content: '\2714';
     text-indent: .9em;
     color: #333;
     background-color: #ccc;
    }
    .funkyradio input[type="radio"]:focus ~ label:before,
    .funkyradio input[type="checkbox"]:focus ~ label:before {
     box-shadow: 0 0 0 3px #999;
    }
    .funkyradio-default input[type="radio"]:checked ~ label:before,
    .funkyradio-default input[type="checkbox"]:checked ~ label:before {
     color: #333;
     background-color: #ccc;
    }
    .funkyradio-primary input[type="radio"]:checked ~ label:before,
    .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
     color: #fff;
     background-color: #337ab7;
    }
    .funkyradio-success input[type="radio"]:checked ~ label:before,
    .funkyradio-success input[type="checkbox"]:checked ~ label:before {
     color: #fff;
     background-color: #5cb85c;
    }
    .funkyradio-danger input[type="radio"]:checked ~ label:before,
    .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
     color: #fff;
     background-color: #d9534f;
    }
    .funkyradio-warning input[type="radio"]:checked ~ label:before,
    .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
     color: #fff;
     background-color: #f0ad4e;
    }
    .funkyradio-info input[type="radio"]:checked ~ label:before,
    .funkyradio-info input[type="checkbox"]:checked ~ label:before {
     color: #fff;
     background-color: #5bc0de;
    }
      </style>
</head>
<body>
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
          <input type="email" name="user" required="required">
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
          <div class="funkyradio">
            <div class="funkyradio-primary">
              <input type="radio" name="radio" id="radio1" value="renter" checked/>
              <label for="radio1">I want to rent spots.</label>
            </div>
            <div class="funkyradio-primary">
              <input type="radio" name="radio" id="radio2" value="owner"/>
              <label for="radio2">I own a spot.</label>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3" align="center">
          <input type="submit" name="register" value="Register">
        </td>
      </tr>

    </table>

    <?php
    include("dbconnect.php");
    if(isset($_POST['register'])) {
      $username = mysqli_real_escape_string($conn,$_POST['user']);
      $pass = mysqli_real_escape_string($conn,$_POST['pass']);
      $pass_check = $_POST['pass_check'];
      if($pass != $pass_check) {
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
      if($check_user == 0) {
        $new_user = "INSERT INTO users(username, pass, privelege) VALUES('$username', '$hashAndSalt', '$priv')";
        $create_user = mysqli_query($conn, $new_user);
        mysqli_close($conn);
        echo "<script>alert('User was successfully created')</script>";
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
