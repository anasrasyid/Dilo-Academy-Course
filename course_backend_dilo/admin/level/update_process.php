<?php

   SESSION_START();

   include("../../database.php");

   $db = new Database(); 

   $id_level = $_POST['id_level'];

   $nama = $_POST['nama'];

    if($id_level && $nama)
    {
        $result = $db->execute("UPDATE level_tbl SET nama= '".$nama."' WHERE id_level = '".$id_level."'");
        if($result){    $_SESSION["notification"] = "UPDATE Level Berhasil";    }
        else{    $_SESSION["notification"] = "UPDATE Level Gagal";     }
    }
    
   header("Location: http://localhost/course_backend_dilo/admin/level.php");

?>