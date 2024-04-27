<?php
include 'connect.php'; // Including the file that contains database connection details

// SIGN UP handling
if(isset($_POST['signUp'])){ // Checking if the sign-up form is submitted
    $name=$_POST['name']; // Getting the user's name from the form
    $email=$_POST['email']; // Getting the user's email from the form
    $password=$_POST['password']; // Getting the user's password from the form
    $password=md5($password); // Hashing the password using MD5 algorithm

    $checkEmail="SELECT * FROM users WHERE email='$email'"; // Query to check if email already exists in the database
    $result=$conn->query($checkEmail); // Executing the query
    if($result->num_rows != 0){ // Checking if email already exists in the database
        echo "Email Address already Exists!"; // Displaying an error message if email already exists
    }
    else{
        // Query to insert user's data into the database
        $insertQuery= "INSERT INTO users(fullname,email,password) VALUES ('$name','$email','$password')";
        if($conn->query($insertQuery) == TRUE){ // Executing the query and checking if insertion is successful
            header("location: login.php"); // Redirecting user to the login page after successful sign-up
        }
        else{
            echo "Error:".$conn->error; // Displaying an error message if insertion fails
        }
    }
}

// SIGN IN handling
if(isset($_POST["signIn"])){ // Checking if the sign-in form is submitted
    $email=$_POST['email']; // Getting the user's email from the form
    $password=$_POST['password']; // Getting the user's password from the form
    $password=md5($password); // Hashing the password using MD5 algorithm

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password); // Binding parameters to the prepared statement
    $stmt->execute(); // Executing the prepared statement
    $result = $stmt->get_result(); // Getting the result of the executed statement

    if ($result->num_rows > 0) { // Checking if user exists in the database
        session_start(); // Starting a session
        $row = $result->fetch_assoc(); // Fetching user's data
        $_SESSION['fullname'] = $row['fullname']; // Storing user's full name in session variable
        $_SESSION['email'] = $row['email']; // Storing user's email in session variable
        header("Location: index.php"); // Redirecting user to the homepage after successful sign-in
        exit(); // Exiting the script
    } else {
        echo "NOT found, Incorrect Email or Password"; // Displaying an error message if sign-in fails
    }
}
?>
