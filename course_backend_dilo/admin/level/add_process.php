<?php

   SESSION_START();

   include("../../database.php");

   $db = new Database(); 

   $id_game = $_POST['id_game'];

   $nama = $_POST['nama'];

    if($nama && $id_game)
    {
        $result = $db->execute("INSERT INTO level_tbl(nama, id_game) VALUES('".$nama."', '".$id_game."')");
        if($result){    $_SESSION["notification"] = "CREATE level Berhasil";    }
        else{    $_SESSION["notification"] = "CREATE Level Gagal";     }
    }

   header("Location: http://localhost/course_backend_dilo/admin/level.php");

?>