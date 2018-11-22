<?php
        // Configuration
        $hostname = 'localhost';
        $database = 'BrainWash';
        $CHAR_SET = "charset=utf8";

        //Variable from the user
        $username = $_POST["username"];
        $password = $_POST["password"];
        $playerID = $_POST["playerID"];
        $playerName = $_POST["playerName"];
        $selectCharacter = $_POST["selectCharacter"];
        $mapSize = $_POST["mapSize"];
				$lastRoomId;

        //Make Connection
        $conn = new mysqli($hostname,$username,$password,$database);
        //Check Connection
        if(!$conn)
				{
        	die("Connection Failed. ". mysqli_connect_error());
        }

        $result = mysqli_query($conn ,"SELECT * FROM  room  WHERE player2_ID IS NULL AND map_size = '".$mapSize."' LIMIT 1 ");

        if(mysqli_num_rows($result) == 1)
        {
          mysqli_query($conn ,"UPDATE room SET player2_ID = '".$playerID."' WHERE player2_ID IS NULL LIMIT 1 ");
          mysqli_query($conn ,"UPDATE room SET player2_name = '".$playerName."' WHERE player2_name IS NULL LIMIT 1 ");
          mysqli_query($conn ,"UPDATE room SET player2_character = '".$selectCharacter."' WHERE player2_character IS NULL LIMIT 1 ");

          $joinRoom = mysqli_query($conn,"SELECT room_id FROM room WHERE player2_ID LIKE '".$playerID."' LIMIT 1");
          $row = mysqli_fetch_assoc($joinRoom);
          echo "".$playerName." Join to room[".$row['room_id']."]";
        }
        else if (mysqli_num_rows($result) == 0)
        {
          echo "Room is fully, ";

          $resultLastRoom = mysqli_query($conn ,"SELECT room_id FROM room ORDER BY room_id DESC LIMIT 1");
          $row = mysqli_fetch_assoc($resultLastRoom);
          $lastRoomId = $row['room_id']; $lastRoomId++;

          mysqli_query($conn ,"INSERT INTO room (room_id,map_size,queue,player1_ID,player2_ID,player1_name,player2_name,player1_character,player2_character,player1_energy,player2_energy,player1_people,player2_people,state)
                                 VALUES ('".$lastRoomId."','".$mapSize."',NULL,'".$playerID."',NULL,'".$playerName."',NULL,'".$selectCharacter."',NULL,NULL,NULL,NULL,NULL,NULL)
                                 ");

          echo "Create new room[".$lastRoomId."]";

        }

?>
