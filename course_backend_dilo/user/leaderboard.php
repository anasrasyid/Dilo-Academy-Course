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

PAGE : LEADERBOARD

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

<form action="http://localhost/course_backend_dilo/user/leaderboard.php" method='GET'>

       Pilih Game

       <select name="gameid">

           <?php

           $gamedata = $db->get("SELECT id_game,nama FROM game_tbl WHERE status=1");
           if($gamedata){
            while($row = mysqli_fetch_assoc($gamedata))

            {
 
                ?>
 
                <option value="<?php echo $row['id_game']?>"><?php echo $row['nama']?></option>
 
                <?php
 
            } 

           }                                
           
           ?>

       </select>

       <input type="submit" value="Tampilkan Leaderboard">

</form>

<?php

if(isset($_GET['gameid']))

{

   echo "LEADERBOARD GAME " .$_GET['gameid'];

   ?>

   <table border=1>

   <tr><td>NO</td><td>NAMA</td><td>SCORE</td></tr>

   <?php

   $leaderboarddata = $db->get("SELECT * FROM game_leaderboard where id_game = ".$_GET['gameid']." ORDER BY score DESC");

   $no = 0;
   while($leaderboarddata &&$row = mysqli_fetch_assoc($leaderboarddata))

   {

       $no++;

       ?>

       <tr>

       <td><?php echo $no?></td>

       <td><?php echo $row['username']?></td>

       <td><?php echo $row['score']?></td>               

       </tr>

       <?php

   }

   ?>

   </table>

   <?php

}

?>