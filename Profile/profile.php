<?php
include_once 'header.php';
if (isset($_SESSION['message'])) {
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']);  // Unset the message
}

// Get the user's email from the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_SESSION['google_email']) ? $_SESSION['google_email'] : null);

// Define $bio with a default value
$bio = 'Bio is not set...';

if ($email) {
    // Fetch the user's details from the database
    $sql = "SELECT id, fullname, image, bio FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Fetch the user's details
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $fullname = $row['fullname'];
        $image = $row['image']; // Get the user's profile picture URL from the database
        $_SESSION['image'] = $row['image'];

        $bio = $row['bio']; // Get the user's bio from the database
        if (empty($bio)) {
            $bio = 'Bio is not set...';
        }

        // Fetch the three most recent posts of the user
        $postLimit = isset($_SESSION['google_loggedin']) ? 4 : 3;
        $sql = "SELECT title, content FROM posts WHERE user_id='$id' ORDER BY timestamp DESC LIMIT $postLimit";
        $result = $conn->query($sql);
        $posts = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
    } else {
        echo "No user found with email: " . $email;
    }
} else {
    echo "No email found in session.";
}
?>

<html5 lang="en" dir="ltr">
<body>
    <main class="profile-container">
        <section class="profile">
            <div class="profile-picture">
                <?php
                // Display the user's profile picture
                if (isset($_SESSION['google_loggedin'])) {
                    echo '<img src="' . $_SESSION['google_picture'] . '" alt="Profile Image">';
                } elseif (isset($_SESSION['email'])) {
                    // Display the user's current profile picture
                    if (isset($_SESSION['image']) && !empty($_SESSION['image'])) {
                        echo '<img class="pf-img" src="images/' . $_SESSION['image'] . '" alt="Profile Image">';
                    } else {
                        echo '<img class="pf-img" src="images/profile.png" alt="Profile Image">'; //default image
                    }
                }
                ?>
            </div>

            <div class="profile-details-container">
                <div class="profile-details">
                    <!-- Display the user's profile details -->
                    <h1 class="heading"><?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Guest'; ?></h1>
                    <p><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_SESSION['google_email']) ? $_SESSION['google_email'] : 'Not logged in'); ?></p>
                </div>

                <!-- Profile Settings and Logout buttons -->
                <div class="profile-actions">
                    <?php
                    // Only show the "Profile Settings" button if the user is not logged in via Google
                    if (!isset($_SESSION['google_loggedin'])) {
                        echo '<button onclick="location.href=\'profile_settings.php\'">Profile Settings</button>';
                    }
                    ?>
                    <button onclick="location.href='logout.php'">Logout</button>
                </div>
            </div>

        </section>

        <div class="bio-post-wrapper">
            <!--Profile bio settings-->
            <?php
            // Only show the bio if the user is not logged in via Google
            if (!isset($_SESSION['google_loggedin'])) {
                echo '<div class="profile-bio"><h3> BIO: </h3>' . $bio . '</div>';
            }
            ?>

            <!-- Recent posts -->
            <section class="recent-posts">
            <h2>Recent Posts:</h2>
            <?php
            if (!empty($posts)):
                foreach ($posts as $post): ?>
                    <div class="post">
                        <h3><?php echo $post['title']; ?></h3>
                        <p><?php echo $post['content']; ?></p>
                    </div>
                <?php
                endforeach;
            else:
                echo '<p>No posts yet.</p>';
            endif;
            ?>
            </section>
        </div>
    </main>
</body>
</html5>