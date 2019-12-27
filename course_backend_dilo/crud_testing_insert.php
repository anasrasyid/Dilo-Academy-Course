<?php

include("database.php"); 

echo "CRUD TESTING<br>";

$test = new Database(); 
 

$test->execute("INSERT INTO game_tbl(nama, status) VALUES('Tebak Saya',true)");

$test->execute("INSERT INTO game_tbl(nama, status) VALUES('Ini Game Apa',true)");

$test->execute("INSERT INTO game_tbl(nama, status) VALUES('Hoax Game',false)");

?>