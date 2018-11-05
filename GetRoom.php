<?php
        // Configuration
        $hostname = 'localhost';
        $username = 'zenzai';
        $password = '*pO6ulzIL&_-';
        $database = 'BrainWash';
				$CHAR_SET = "charset=utf8";

        $inroom = "100";

        $conn = new mysqli($hostname,$username,$password,$database);

				if(!$conn){
					die("Connection Failed. ". mysqli_connect_error());
				}

				$sql = "SELECT room_id, id_player1, id_player2 FROM room";
				$result = mysqli_query($conn ,$sql);

        if(mysqli_num_rows($result) > 0)
		{
					//show data for each row
			while($row = mysqli_fetch_assoc($result))
			{

					if($row['room_id'] == $inroom)
					{
					echo "Room:".$row['room_id']." Name_P1:".$row['id_player1']. " Name_P2:".$row['id_player2'].";";
					break;
					}
			}
		}



?>
