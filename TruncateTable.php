<?php
        // Configuration
        $hostname = 'localhost';
        $database = 'BrainWash';
        $CHAR_SET = "charset=utf8";

        //Variable from the user
        $username = $_POST["username"];
        $password = $_POST["password"];
        $room_id = $_POST["room_id"];
        $map = $_POST["map"];

        $conn = new mysqli($hostname,$username,$password,$database);

        if(!$conn)
        {
					die("Connection Failed. ". mysqli_connect_error());
				}
        else
        {
          mysqli_query($conn ,"TRUNCATE TABLE `".$room_id."` ");
          echo "TRUNCATE TABLE '".$room_id."', Succeeded";
        }

?>
