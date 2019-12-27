<?php

   SESSION_START();

   include("../../database.php");

   $db = new Database(); 

   $id_game = $_POST['id_game'];

   $status = $_POST['statusgame'];

    if($id_game)
    {
        $result = $db->execute("UPDATE game_tbl SET status= $status WHERE id_game = '".$id_game."'");
        if($result){    $_SESSION["notification"] = "UPDATE Game Berhasil";    }
        else{    $_SESSION["notification"] = "UPDATE Game Gagal";     }
    }
    
   header("Location: http://localhost/course_backend_dilo/admin/game.php");

?>