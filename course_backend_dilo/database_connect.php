<?php

$servername = "localhost";  

$username = "root";         

$password = "";             

$dbname = "course_backend_dilo_db"; 

 
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {

   die("Connection failed: " . mysqli_connect_error()); // jika gagal, maka akan koneksi akan dihentikan

}

?>