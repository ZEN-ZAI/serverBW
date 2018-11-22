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
        $mapSize = $_POST["mapSize"];

        $tempMap = explode('|',$map);

        for ($i=0; $i < 100 ; $i++)
        {
          echo $tempMap[i];
        }

        $conn = new mysqli($hostname,$username,$password,$database);

        if(!$conn)
        {
					die("Connection Failed. ". mysqli_connect_error());
				}
        else
        {
          $num = 0;
          for ($i=0; $i <$mapSize ; $i++)
          {
            for ($j=0; $j <$mapSize ; $j++)
            {
              if($tempMap[$num] != "_")
              {
                  mysqli_query($conn ,"UPDATE `".$room_id."` SET block = '".$tempMap[$num]."' WHERE block_number LIKE '".$num."' ");
              }
              else
              {
                mysqli_query($conn ,"UPDATE `".$room_id."` SET block = NULL WHERE block_number LIKE '".$num."' ");
              }
              //echo "$map[$num],";
              $num++;
            }
          }
          echo "Update Map, Succeeded";
        }

?>
