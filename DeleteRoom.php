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

        if(!$conn){
					die("Connection Failed. ". mysqli_connect_error());
				}

        $result = mysqli_query($conn ,"DROP TABLE `".$room_id."` ");

        if(!mysqli_error($result))
        {
          mysqli_query($conn ,"DELETE FROM room WHERE room_id = `".$room_id."`");
          echo "Delete Table, `".$room_id."` ";
        }

?>
