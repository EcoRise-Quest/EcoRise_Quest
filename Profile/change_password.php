<?php
include_once 'header.php';

// Get the user's email from the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_SESSION['google_email']) ? $_SESSION['google_email'] : null);

if ($email) {
    // Fetch the user's details from the database
    $sql = "SELECT id, fullname FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Fetch the user's details
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $fullname = $row['fullname'];
    } else {
        echo "No user found with email: " . $email;
    }
} else {
    echo "No email found in session.";
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the new password and confirmation password
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password and confirmation password match
    if ($new_password === $confirm_password) {
        // Get the new password from the form and hash it
        $new_password = md5($new_password);

        // Update the user's password in the database
        $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully";
            // After changing the password
            $_SESSION['message'] = "Password updated successfully!";
            header("Location: profile.php");
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo '<script>alert("Passwords do not match!");</script>';
    }
}
?>

<html5>
<body>
    <main>
        <section class="profile-settings">
            <a href="profile_settings.php"><i class="fa-solid fa-arrow-left" style="font-size: 22px; color: #63327F"></i></a>

            <form id="form" method="post" action="">
                <!--New password field-->
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <br />
                <!--Confirm new password field-->
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <input type="submit" name="submit" value="Save Changes">
            </form>
        </section>
    </main>
</body>
</html5>
