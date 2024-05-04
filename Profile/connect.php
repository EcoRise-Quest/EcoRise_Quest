<?php
$serverName = "127.0.0.1";
$port = 3306; // Replace with your MySQL server's port if it's not the default
$username = "root";
$password = "";
$dbname = "ecorise";

$conn = mysqli_connect($serverName, $username, $password, $dbname, $port);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}