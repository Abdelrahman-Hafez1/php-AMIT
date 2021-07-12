<?php

/*
    - PDO => php data object

    connect php files with dataBase 
*/

$dsn = 'mysql:host=localhost;dbname=session 4';
$username = 'root';
$password = '';
try{
    $con = new PDO($dsn, $username , $password);
    // echo 'you are connected';
}catch(PDOException $error){
    echo $error->getMessage();
}

?>