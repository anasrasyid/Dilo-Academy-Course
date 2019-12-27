<?php

   SESSION_START();

   include("../database.php");

   $db = new Database(); 

   $username = $_POST['username'];

   $nama = $_POST['nama'];

   $email = $_POST['email'];

   $token = ""; 

   $password = md5($_POST['password']);

   $password2 = md5($_POST['password2']);   

   if($password == $password2)

   {

       if($username && $nama && $email )

       {

           $result = $db->execute("INSERT INTO user_tbl(username, nama, password, token, email) VALUES('".$username."','".$nama."','".$password."','".$token."','".$email."')");

           if($result){    $_SESSION["notification"] = "Register User Berhasil";    }

           else{    $_SESSION["notification"] = "Register User Gagal";     }

       }

   }

   header("Location: http://localhost/course_backend_dilo/");   

?>