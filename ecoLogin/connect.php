<?php
$serverName = "127.0.0.1"; // Replace it with localhost
$port = 3307; // Replace with your MySQL server's port if it's not default or just remove it
$username = "root";
$password = "";
$dbname = "ecorise"; //replace it with your database name

$conn = mysqli_connect($serverName, $username, $password, $dbname, $port);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
