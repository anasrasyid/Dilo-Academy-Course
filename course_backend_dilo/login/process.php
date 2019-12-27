<?php

   SESSION_START();

   include("../database.php"); 

   $db = new Database(); 

   $username = $_POST['username'];

   $password = md5($_POST['password']);

   $result = $db->get("SELECT username,status FROM user_tbl WHERE username = '".$username."' AND password='".$password."' AND status = 1");

   if($result){
       $status = true;
   }

   $result = $db->get("SELECT username,status FROM user_tbl WHERE username = '".$username."' AND password='".$password."'");

   if($result)

   {

       $_SESSION['notification'] = "Berhasil Login, Selamat Datang";

       $token = md5($nik."coursebackend".date("Y-m-d H:i:s"));

       $db->execute("UPDATE user_tbl SET token = '".$token."' WHERE username  = '".$username."'"); // update token to user_tbl

       $_SESSION['token'] = $token;

       $_SESSION['username'] = $username;

       $_SESSION['status'] = $status;

       if($status){
        header("Location: http://localhost/course_backend_dilo/admin/");
       }

       header("Location: http://localhost/course_backend_dilo/user/");

   }

   $_SESSION['notification'] = "Gagal Login, Coba lagi";

   header("Location: http://localhost/course_backend_dilo/");

?>