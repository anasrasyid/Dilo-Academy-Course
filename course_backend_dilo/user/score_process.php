<?php

   SESSION_START();

   include("../database.php");

   $db = new Database(); 

   $username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";

   $id_level = $_POST['id_level'];

   $score = $_POST['score'];

    if($username && $id_level && $score )
    {
        $result = $db->execute("INSERT INTO interaksi_tbl(id_level, username, score) VALUES('".$id_level."','".$username."',$score)");
        if($result){    $_SESSION["notification"] = "Tambah Score Berhasil";    }
        else{    $_SESSION["notification"] = "Tambah Score Gagal";     }
    }

   header("Location: http://localhost/course_backend_dilo/user");

?>