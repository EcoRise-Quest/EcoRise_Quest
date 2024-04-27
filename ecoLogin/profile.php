<!--Still Updating! Keep this for now-->

<?php
include_once 'header.php';
?>

<html5>
<body>
    <main>
        <section class="profile">
            <div class="profile-picture">
                <?php
                // Display the user's profile picture
                if (isset($_SESSION['google_loggedin'])) {
                    echo '<img src="' . $_SESSION['google_picture'] . '" alt="Profile Image">';
                } elseif (isset($_SESSION['email'])) {
                    echo '<img src="images/profile.png" alt="Profile Image" style="width:230px; height:230px;">';
                }
                ?>
            </div>

            <div class="profile-details">
                <!-- Display the user's profile details -->
                <h1><?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Guest'; ?></h1>
                <p><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_SESSION['google_email']) ? $_SESSION['google_email'] : 'Not logged in'); ?></p>
            </div>

            <!-- Profile Settings and Logout buttons -->
            <div class="profile-actions">
                <button onclick="location.href='settings.php'">Profile Settings</button>
                <button onclick="location.href='logout.php'">Logout</button>
            </div>

        </section>
    </main>
</body>
</html5>
