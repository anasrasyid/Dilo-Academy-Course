<?php

include("database.php"); 

echo "Insert Level<br>";

$test = new Database(); 
 
for($i = 1; $i <= 3; $i++){
    for($j = 1; $j <=(6 - $i);$j++){
        $s = "INSERT INTO level_tbl(nama, id_game) VALUES('Level - 0$j',$i)";
        $test->execute($s);
    }
}

?>