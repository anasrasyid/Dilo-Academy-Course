<?php


class Database

{

   function execute($query) 

   {

       include("database_connect.php");

       if (mysqli_query($conn, $query)) {

           mysqli_close($conn);       

           return true;

       }       

       mysqli_close($conn);       

       return false;

   }

   function get($query) 

   {

       include("database_connect.php");       

       $result = $conn->query($query);

       if ($result->num_rows > 0)

       {

           $conn->close();

           return $result;

       }

       $conn->close();

       return null;

   }

   function get_procedure_execute($procedure) 
   {

       include("database_connect.php");

       return mysqli_query($conn,"CALL ".$procedure);

   }  

}

?>