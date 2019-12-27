<?php

SESSION_START();

include("../database.php");

$db = new Database();

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $username)

{

   $result = $db->execute("SELECT * FROM user_tbl WHERE username = '".$username."' AND token = '".$token."'");

   if(!$result)

   {

       header("Location: http://localhost/course_backend_dilo/");

   }


   $userdata = $db->get("SELECT user_tbl.username as username, user_tbl.nama as nama, user_tbl.email as email

                       from user_tbl WHERE user_tbl.username = '".$username."'");               

   $userdata = mysqli_fetch_assoc($userdata);                       

}

else

{

   header("Location: http://localhost/course_backend_dilo/");

}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);   

}

?>

PAGE ADMIN : HOME

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/course_backend_dilo/admin/">HOME</a></td>

       <td><a href="http://localhost/course_backend_dilo/admin/game.php">GAME</a></td>       

       <td><a href="http://localhost/course_backend_dilo/admin/level.php">LEVEL</a></td>

       <td><a href="http://localhost/course_backend_dilo/user/logout.php">LOGOUT</a></td>

   </tr>

   <tr><td align="center" colspan=5>Profile</td></tr>

   <tr><td>USERNAME</td><td colspan=4><?php echo $userdata['username'];?></td></tr>

   <tr><td>NAMA</td><td colspan=4><?php echo $userdata['nama'];?></td></tr>

   <tr><td>EMAIL</td><td colspan=4><?php echo $userdata['email'];?></td></tr>

</table>