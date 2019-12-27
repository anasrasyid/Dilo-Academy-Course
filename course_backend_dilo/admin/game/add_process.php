<?php

   SESSION_START();

   include("../../database.php");

   $db = new Database(); 

   $nama = $_POST['nama'];

   $status = $_POST['status'];

    if($nama)
    {
        $result = $db->execute("INSERT INTO game_tbl(nama, status) VALUES('".$nama."', $status)");
        if($result){    $_SESSION["notification"] = "CREATE Game Berhasil";    }
        else{    $_SESSION["notification"] = "CREATE Game Gagal";     }
    }

   header("Location: http://localhost/course_backend_dilo/admin/game.php");

?>