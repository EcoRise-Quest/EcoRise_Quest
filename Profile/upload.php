<?php
include_once 'header.php';

if (!isset($_SESSION['id']) && !isset($_SESSION['google_loggedin'])) {
    echo "You must be logged in to upload a post.";
    exit();
}

// If the user is logged in with Google, get their user_id from the database
if (isset($_SESSION['google_email'])) {
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['google_email']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
    } else {
        echo "No user found with this email.";
        exit();
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the uploaded file information
    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Get the post title and content
    $title = $_POST["title"];
    $content = $_POST["content"];

    //image validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
        echo '<script>alert("Invalid Image Extension!");</script>';
    } elseif ($imageSize > 1200000) {
        echo '<script>alert("Image size too large!");</script>';
    } else {
        $newImageName = "post_" . date("Y.m.d") . "_" . date("h.i.sa") . "." . $imageExtension;
        move_uploaded_file($tmpName, 'images/' . $newImageName);

        // Save the image name, title, and content into the database
        $sql = "INSERT INTO posts (user_id, title, content, image, timestamp) VALUES (?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $_SESSION['id'], $title, $content, $newImageName);
        if ($stmt->execute()) {
            echo '<script>alert("Post uploaded successfully!");</script>';
            header('Location: forum.php'); // Redirect to forum.php
            exit();
        } else {
            echo "Error uploading post: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<html5>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content"></textarea><br>
        <label for="post_image">Select image:</label><br>
        <input type="file" id="post_image" name="image"><br>
        <input type="submit" value="Upload Post" name="submit">
    </form>
</body>
</html5>