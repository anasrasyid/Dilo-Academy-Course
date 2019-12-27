<?php

include("database.php");

echo "CRUD TESTING<br>";

$test = new Database(); 
 

$getdata = $test->get("SELECT id_game, nama , status FROM game_tbl WHERE status = 1");

 

while($row = mysqli_fetch_assoc($getdata)) {

   echo "game_ID: " . $row["id_game"]. " - Nama: " . $row["nama"]. " - Status: " . $row["status"]."<br>";

}

?>