<?php

   SESSION_START();

   include("../../database.php");

   $db = new Database(); 

   $id_game = $_POST['id_game'];

    if($id_game)
    {
        try {
            $level = $db->get_procedure_execute("GET_LEVEL_ONLY");
            while($level && $row = mysqli_fetch_assoc($game)){
                $id_level = $row['id_level'];
                $db->execute("DELETE from interaksi_tbl where id_level = '".$id_level."' ");
            }
            $db->execute("DELETE from level_tbl where id_game = '".$id_game."' ");
            $db->execute("DELETE from game_tbl where id_game = '".$id_game."' ");
            $_SESSION["notification"] = "DELETE Game Berhasil";
        } catch (Exception $e) {
            $_SESSION["notification"] = "DELETE Game GAGAL";
        }
        
    }
    
   header("Location: http://localhost/course_backend_dilo/admin/game.php");

?>