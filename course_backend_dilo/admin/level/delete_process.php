<?php

   SESSION_START();

   include("../../database.php");

   $db = new Database(); 

   $id_level = $_POST['id_level'];

    if($id_level)
    {
        try {
            $db->execute("DELETE from interaksi_tbl where id_level = '".$id_level."' ");
            $db->execute("DELETE from level_tbl where id_level = '".$id_level."' ");
            $_SESSION["notification"] = "DELETE Level Berhasil";
        } catch (Exception $e) {
            $_SESSION["notification"] = "DELETE Level GAGAL";
        }
        
    }
    
   header("Location: http://localhost/course_backend_dilo/admin/level.php");

?>