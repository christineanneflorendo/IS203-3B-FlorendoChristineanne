<?php

$host ='localhost';
$user ='root';
$password ='';
$database ='db1';
$port = 3306;

$connection = mysqli_connect($host, $user, $password, $database, $port);

if (mysqli_connect_error()){

    echo "Error: unable to connect to MySQL <br>";
    echo "message:".mysqli_connect_error()."<br>";
}

?>