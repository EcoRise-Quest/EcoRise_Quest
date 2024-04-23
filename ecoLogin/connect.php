<?php 

// Database connection parameters
$host="localhost";  // Hostname of the database server
$user="root";       // Username for accessing the database
$pass= "";          // Password for accessing the database
$db="login";        // Name of the database

// Establishing connection to the database
$conn=mysqli_connect($host,$user,$pass,$db);

// Checking if connection was successful
if($conn->connect_error){
    echo "Failed to connect DB: " . $conn->connect_error; // Output error message if connection fails
}

?>
