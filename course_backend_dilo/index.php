<?php

SESSION_START();

include("database.php"); 

$db = new Database(); 

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

$status = (isset($_SESSION['status'])) ? $_SESSION['status'] : false;

if($username && $token)

{

   $result = $db->execute("SELECT * FROM user_tbl WHERE username = '".$username."' AND token = '".$token."'");

   if($result)

   {
       if($status){
         header("Location: http://localhost/course_backend_dilo/admin/");
       }else{
          header("Location: http://localhost/course_backend_dilo/user/");
       }

   }


}


 

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);

}

?>

PAGE : LOGIN

<form action="login/process.php" method="POST">

<table>

   <tr>

       <td>username</td>

       <td>:</td>

       <td><input type="text" name="username" required></td>

   </tr>

   <tr>

       <td>password</td>

       <td>:</td>

       <td><input type="password" name="password" required></td>

   </tr>

   <tr>

       <td colspan=3><input type="submit" value="LOGIN"></td>

   </tr>       

   </form>   

   <tr>

       <td colspan=3><button><a href="register.php">REGISTER</a></button></td>

   </tr>           

</table>