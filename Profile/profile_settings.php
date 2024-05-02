<?php
include_once 'header.php';

// Get the user's email from the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_SESSION['google_email']) ? $_SESSION['google_email'] : null);

if ($email) {
    // Fetch the user's details from the database
    $sql = "SELECT id, fullname, image, bio FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Fetch the user's details
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $fullname = $row['fullname'];
        $image = $row['image']; // Get the user's profile picture URL from the database
        $bio = $row['bio']; // Get the user's bio from the database
    } else {
        echo "No user found with email: " . $email;
    }
    $stmt->close();
} else {
    echo "No email found in session.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The user submitted the form, update their bio
    $bio = $_POST['bio'];
    $sql = "UPDATE users SET bio=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $bio, $email);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Bio updated successfully!";
        header('Location: profile.php');
        exit();
    } else {
        echo "Error updating bio: " . $stmt->error;
    }
    $stmt->close();
}
?>

<html5>
<body>
    <main>
        <section class="profile-settings">
            <a href="profile.php"><i class="fa-solid fa-arrow-left" style="font-size: 22px; color: #63327F"></i></a>

            <!-- Display the user's current profile picture -->
            <?php
            $default_image = 'images/profile.png';
            $image_src = isset($_SESSION['image']) && !empty($_SESSION['image']) ? 'images/' . $_SESSION['image'] : $default_image;
            ?>

            <img src="<?php echo $image_src; ?>" alt="Profile Image" style="width:230px; height:230px; border-radius: 50%;" title="<?php echo $image; ?>">

            <!-- Button for changing the profile picture -->
            <button onclick="location.href='change_picture.php'">Change Profile Picture</button>

            <!-- Button for changing the password -->
            <button class="cpwd" onclick="location.href='change_password.php'">Change Password</button>

            <form method="POST">
                <textarea name="bio" placeholder="Your bio here..."><?php echo $bio; ?></textarea>
                <input type="submit" value="Update Bio">
            </form>

        </section>
    </main>
</body>
</html5>
