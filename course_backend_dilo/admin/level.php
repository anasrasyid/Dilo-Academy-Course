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

PAGE ADMIN : LEVEL 

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

       <td><a href="http://localhost/course_backend_dilo/admin/level/add.php">ADD</a></td>

       <td><a href="http://localhost/course_backend_dilo/admin/level/delete.php">DELETE</a></td>       

       <td><a href="http://localhost/course_backend_dilo/admin/level/update.php">UPDATE</a></td>

   </tr>

</table>

<form action="http://localhost/course_backend_dilo/admin/level.php" method='GET'>

Pilih Game

<select name="gameid">

    <?php

    $gamedata = $db->get("SELECT id_game,nama FROM game_tbl");                                

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

<input type="submit" value="Tampilkan Level">

</form>

<?php

if(isset($_GET['gameid']))

    {

    echo "Level GAME " .$_GET['gameid'];

    ?>

    <table border=1>

    <tr><td>NO</td><td>ID Level</td><td>Nama Level</td></tr>

    <?php

    $leveldata = $db->get("SELECT * FROM level_tbl where id_game = ".$_GET['gameid']."");

    $no = 0;
    if($leveldata){
        while($row = mysqli_fetch_assoc($leveldata))
        {

        $no++;

        ?>

        <tr>

        <td><?php echo $no?></td>

        <td><?php echo $row['id_level']?></td>

        <td><?php echo $row['nama']?></td>               

        </tr>



        <?php
        }
    }

    ?>

    </table>

    <?php

}

?>