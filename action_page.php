<html>
<body>
  <?php ?>
    <?php

    $db = 'tutorial';
    $conn = mysqli_connect("localhost:8889", "root", "root");
// Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }



    mysqli_select_db($conn, $db);
    $sql = "INSERT INTO Names (Word) VALUES (4)";
    if (mysqli_query($conn, $sql)) {
      echo "Sexy bitch worked";
    } else {
      echo "wat heck, boi, ill do ya a slither: " . mysqli_error($conn);
    }

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
