<?php
        // Configuration
        $hostname = 'localhost';
        $database = 'BrainWash';
        $CHAR_SET = "charset=utf8";

        //Variable from the user
        $username = $_POST["username"];
        $password = $_POST["password"];
        $player_name = $_POST["playername"];
        $select_character = $_POST["select_character"];
        $map_size = $_POST["map_size"];
				$lastRoomId;

        //Make Connection
        $conn = new mysqli($hostname,$username,$password,$database);
        //Check Connection
        if(!$conn)
				{
        	die("Connection Failed. ". mysqli_connect_error());
        }

        $result = mysqli_query($conn ,"SELECT * FROM  room  WHERE player2_name IS NULL AND mapSize = '".$map_size."' LIMIT 1 ");

        if(mysqli_num_rows($result) == 1)
        {
          mysqli_query($conn ,"UPDATE room SET player2_name = '".$player_name."' WHERE player2_name IS NULL LIMIT 1 ");
          mysqli_query($conn ,"UPDATE room SET player2_character = '".$select_character."' WHERE player2_character IS NULL LIMIT 1 ");

          $joinRoom = mysqli_query($conn,"SELECT room_id FROM room WHERE player2_name LIKE '".$player_name."' LIMIT 1");
          $row = mysqli_fetch_assoc($joinRoom);
          echo "".$player_name." Join to room[".$row['room_id']."]";
        }
        else if (mysqli_num_rows($result) == 0)
        {
          echo "Room is fully, ";

          $resultLastRoom = mysqli_query($conn ,"SELECT room_id FROM room ORDER BY room_id DESC LIMIT 1");
          $row = mysqli_fetch_assoc($resultLastRoom);
          $lastRoomId = $row['room_id']; $lastRoomId++;

          mysqli_query($conn ,"INSERT INTO room (room_id,map_size,player1_name,player2_name,player1_Character,player2_Character,queue)
                                 VALUES ('".$lastRoomId."','".$map_size."','".$player_name."',NULL,'".$select_character."',NULL,NULL)
                                 ");

          echo "Create new room[".$lastRoomId."]";

        }

?>
