<?php
        // Configuration
        $hostname = 'localhost';
        $database = 'BrainWash';
        $CHAR_SET = "charset=utf8";

        //Variable from the user
        $username = $_POST["username"];
        $password = $_POST["password"];
        $room_id = $_POST["room_id"];

        $conn = new mysqli($hostname,$username,$password,$database);

        if(!$conn)
        {
          die("Connection Failed. ". mysqli_connect_error());
        }
        else
        {
          $result = mysqli_query($conn ,"SELECT * FROM `".$room_id."` ");
          if(mysqli_num_rows($result) > 0)
          {
            while($row = mysqli_fetch_assoc($result))
            {
              echo "".$row['block'].";";
            }
          }
        }

?>
