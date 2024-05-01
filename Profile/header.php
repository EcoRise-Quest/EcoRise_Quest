<?php
session_start();
include ('connect.php');
?>

<!DOCTYPE html>
<html5 lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0">
    <title>Ecorise Quest 🍀</title>
    <!-- Linking the Font Awesome library for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!--Importing font from Google fonts-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <header>
        <div class="logo"><a href="index.php">ECORISE QUEST</a></div> <!--for logo-->
        <nav class="navigation-bar">
            <ul>
                <li><a href="#">Challenges</a></li>
                <li><a href="forum.php">Our Community</a></li>
                <li><a href="#">About Us</a></li>

                <!--Profile login-->
                <?php
                // Check if the user is logged in
                if (isset($_SESSION['google_loggedin'])) {
                    // Display the Google profile image if the user is logged in with Google
                    echo '<li><a href="profile.php"><img src="' . $_SESSION['google_picture'] . '" alt="Profile Image"></a></li>';
                } elseif (isset($_SESSION['email'])) {
                    // Display a default profile image if the user is logged in with email
                    if (isset($_SESSION['image']) && !empty($_SESSION['image'])) {
                        echo '<li><a href="profile.php"><img src="images/' . $_SESSION['image'] . '" alt="Profile Image"></a></li>';
                    } else {
                        echo '<li><a href="profile.php"><img src="images/profile.png" alt="Profile Image"></a></li>'; //default image
                    }
                } else {
                    // Display the login button if the user is not logged in
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
</body>
</html5>