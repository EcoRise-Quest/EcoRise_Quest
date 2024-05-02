<?php
include_once 'header.php';

// Fetch all posts from the database
$sql = "SELECT posts.id, posts.user_id, posts.title, posts.content, posts.timestamp, posts.image AS post_image, users.fullname, users.image AS user_image FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.timestamp DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each post
    while ($row = $result->fetch_assoc()) {
        echo '<div class="post">';
        echo '<div class="post-header">';

        // Check if the image URL is a full URL (Google profile picture) or a path to an image in the images directory
        if (filter_var($row['user_image'], FILTER_VALIDATE_URL)) {
            $user_image = $row['user_image'];
        } else {
            $user_image = 'images/' . (!empty($row['user_image']) ? $row['user_image'] : 'profile.png');
        }
        echo '<img src="' . $user_image . '" alt="Profile Image" style="width:100px; height:100px;">'; // Display the user's profile image

        echo '<h2>' . $row['fullname'] . '</h2>'; // Display the user's name
        echo '</div>';
        echo '<h3>' . $row['title'] . '</h3>'; // Display the post title
        echo '<p>' . $row['content'] . '</p>'; // Display the post content
        if (!empty($row['post_image'])) {
            echo '<img src="images/' . $row['post_image'] . '" alt="Post Image">'; // Display the post image
        }
        echo '<p>Posted on ' . $row['timestamp'] . '</p>'; // Display the post timestamp

        // If the post was created by the currently logged-in user, display the "Delete" button
        if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) {
            echo '<form action="delete_post.php" method="POST">';
            echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
            echo '<input type="submit" value="Delete Post">';
            echo '</form>';
        }

        echo '</div>';
    }
} else {
    echo "No posts found.";
}
?>

<!DOCTYPE html>
<html5>
<body>
    <a href="upload.php" class="button">Create Post</a>
</body>
</html5>