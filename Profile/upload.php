<?php
include_once '.\headFoot\header.php'; //change the file path 
?>

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
    </div>
    <!--Recent posts heading-->
    <div class = "post_divider">
        <h2>Add New Post</h2>
        <hr></hr>
        <p>Small actions, multiplied by millions, can transform the world.🌿</p>
    </div></br></br>

    <!--creating post form section-->
    <form class="new_post" action="upload.php" method="post" enctype="multipart/form-data"></br>
        <h2>Create Post</h2></br>
        <hr></hr></br>
        <label class="title" for="title">Title</label>
        <input type="text" id="title" name="title"><br>
        <label for="content">Content</label>
        <textarea id="content" name="content"></textarea><br>
        <label class="up_img" for="post_image">Upload image</label><br></br>
        <div class="upload">
            <i class="fa-solid fa-cloud-arrow-up icon"></i>
            <p>Image size must be less than <strong>2MB</strong></p>
            <input type="file" id="post_image" name="image"><br>
        </div></br>
            <input type="submit" id="post" value="Post" name="submit">
    </form></br></br></br></br></br></br></br></br></br></br>
</body>
</html>

<?php
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
        if(move_uploaded_file($tmpName, 'img/' . $newImageName)){
            echo 'File uploaded successfully!';
        }
        else{
            echo 'File upload error: '.$_FILES["image"]["error"];
        }

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

