<?php
include_once '.\headFoot\header.php'; //change the file path 
?>

<!DOCTYPE html>
<html>
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Linking an external CSS file named "forum.css" -->
	<link rel="stylesheet" type="text/css" href="forum.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>Eco Community Forum</title>
</head>
<body>
    <!---Container for the banner-->
    <div class = "banner">
        <h2> Join Our Community and</br> Share Your Experience </h2>
        <p>Share your eco-journey! Post and inspire others 
            with your</br>sustainability experiences.</p>
        <a href="upload.php" class="button">Create Post</a>
    </div>
    <!--Recent posts heading-->
    <div class = "post_divider">
        <h2>Recent Posts</h2>
        <hr></hr>
        <p>Small actions, multiplied by millions, can transform the world.🌿</p>
    </div>
</body>
</html>
</br></br></br>

<?php
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
            $user_image = 'img/profile.png' . (!empty($row['user_image']) ? $row['user_image'] : 'profile.png');
        }
        echo
        '<div class="profile_username">
        <img src="' . $user_image . '" alt="Profile Image">'; // Display the user's profile image

        echo '<h1 class="username">' . $row['fullname'] . '</h1>'. '</div>'; // Display the user's name
         //Delete post 
        // If the post was created by the currently logged-in user, display the "Delete" button
        if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) {
            echo '<form class="del_form" action="delete_post.php" method="POST">';
            echo '<input type="hidden" name="post_id" value="' . $row['id'] . '">';
            echo '<div class="delete_wrapper">';
            echo '<button type="submit" class="delete_btn"><i class="fa-solid fa-trash-can icon"></i></button>';
            echo '</div>';
            echo '</form>';
        }
        echo '</div>';
        echo '<div class="post-content">';
        echo '<h3>' . $row['title'] . '</h3>'; // Display the post title
        echo '<hr></hr>';
        echo '<p>' . $row['content'] . '</p>'; // Display the post content
        if (!empty($row['post_image'])) {
            echo '<img src="img/' . $row['post_image'] . '" alt="Post Image">'; // Display the post image
        }
        echo '<p><strong>Posted on: </strong>' . $row['timestamp'] . '</p>'; // Display the post timestamp
        echo '</div>';

        echo '</div>';
    }
    
    echo'</br></br></br>';
} else {
    echo "No posts found.";
}
?>
