<?php

SESSION_START();

include("../../database.php");

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

PAGE ADMIN : GAME 

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/course_backend_dilo/admin/">HOME</a></td>

       <td><a href="http://localhost/course_backend_dilo/admin/game.php">GAME</a></td>       

       <td><a href="http://localhost/course_backend_dilo/admin/level.php">LEVEL</a></td>

       <td><a href="http://localhost/course_backend_dilo/user/logout.php">LOGOUT</a></td>

   </tr>

   <tr><td align="center" colspan=5>SUB MENU GAME</td></tr>

   <tr>

       <td><a href="http://localhost/course_backend_dilo/admin/game/add.php">ADD</a></td>

       <td><a href="http://localhost/course_backend_dilo/admin/game/delete.php">DELETE</a></td>       

       <td><a href="http://localhost/course_backend_dilo/admin/game/update.php">UPDATE</a></td>

   </tr>

   <tr><td>NO</td><td>NAMA</td><td>Status</td></tr>

   <?php

   $game = $db->get_procedure_execute("GET_GAME");

   $no = 0;

   while($game && $row = mysqli_fetch_assoc($game))

   {

       $no++;

       ?>

       <tr>

       <td><?php echo $no?></td>

       <td><?php echo $row['nama']?></td>

       <td><?php echo $row['status']?></td>               

       </tr>

       <?php

   }

   ?>
   <td>Note : Active = 1</a></td>

</table>

<br>
<form action="add_process.php" method="POST">

<table>

  <tr>

      <td>Nama Game</td><td>:</td><td><input type="text" name="nama" required></td>

  </tr>

  <tr>

      <td>status</td><td>:</td><td><input type="number" min = "0" max = "1" name="status" required></td>

  </tr>

  <tr>

      <td colspan=3><input type="submit" value="CREATE"></td>

  </tr>      

</table>

</form>