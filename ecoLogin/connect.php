<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "ecorise"; //replace it with your database name

$conn = mysqli_connect($serverName, $username, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
