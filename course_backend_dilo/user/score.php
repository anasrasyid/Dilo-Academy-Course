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

PAGE : SCORE

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/course_backend_dilo/user/">HOME</a></td>

       <td><a href="http://localhost/course_backend_dilo/user/score.php">SCORE</a></td>       

       <td><a href="http://localhost/course_backend_dilo/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/course_backend_dilo/user/logout.php">LOGOUT</a></td>

   </tr>

   
</table>
<br>
<form action="score_process.php" method="POST">

<table>
    <tr>

      <td>Pilih Game Dan level</td><td>:</td>

      <td>

          <select name="id_level" required>

              <option value="">- SELECT -</option>

          <?php

          $game = $db->get_procedure_execute("GET_LEVEL");

          if($game)

          {

              while($row = mysqli_fetch_assoc($game))

              {

                  ?>

                  <option value="<?php echo $row['id_level'] ?>"><?php echo $row['nama']?></option>

                  <?php

              }

          }

          ?>

          </select>

      </td>

  </tr>

  <tr>

      <td>score</td><td>:</td><td><input type="number" min="0" max ="100" name="score" required></td>

  </tr>  

  <tr>

      <td colspan=3><input type="submit" value="ADD"></td>

  </tr>      

</table>

</form>