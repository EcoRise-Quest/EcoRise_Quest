<?php
include_once 'header.php';

// Get the user's email from the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : (isset($_SESSION['google_email']) ? $_SESSION['google_email'] : null);

if ($email) {
    // Fetch the user's details from the database
    $sql = "SELECT id, fullname, image FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Fetch the user's details
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $fullname = $row['fullname'];
        $image = $row['image']; // Get the user's profile picture URL from the database
    } else {
        echo "No user found with email: " . $email;
    }
} else {
    echo "No email found in session.";
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the uploaded file information
    $imageName = $_FILES["pfp"]["name"];
    $imageSize = $_FILES["pfp"]["size"];
    $tmpName = $_FILES["pfp"]["tmp_name"];

    //image validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
        echo '<script>alert("Invalid Image Extension!");</script>';
    } elseif ($imageSize > 1200000) {
        echo '<script>alert("Image size too large!");</script>';
    } else {
        $name = $_SESSION['fullname'];
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa");

        $newImageName .= "." . $imageExtension;
        // This is where you update the user's profile picture in the database
        $query = "UPDATE users SET image = '$newImageName' WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            // The database was updated successfully, now update the session variable
            $_SESSION['image'] = $newImageName;
            move_uploaded_file($tmpName, 'images/' . $newImageName);
            echo '<script>alert("Profile picture updated successfully!");</script>';
            header('Location: profile.php'); // Redirect to profile.php
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>

<html5>
<body>
    <main>
        <section class="profile-settings">
            <a href="profile_settings.php"><i class="fa-solid fa-arrow-left" style="font-size: 22px; color: #63327F"></i></a>

            <form id="form" method="post" action="" enctype="multipart/form-data">
                <!-- fields for profile picture upload -->
                <div class="circle">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="hidden" name="fullname" value="<?php echo $fullname; ?>"/>
                    <img src="images/<?php echo $image; ?>" alt="Profile Image" style="width:200px; height:200px;">
                    <label for="image">
                        <span class="camera-icon">
                            <i class="fa-solid fa-camera"></i>
                        </span>
                    </label>
                    <input type="file" name="pfp" id="image" accept=".jpg, .jpeg, .png"/>
                </div>

                <input type="submit" name="submit" value="Update Picture">
            </form>
        </section>
    </main>

    <script src="javascripts/script.js"></script>
</body>
</html5>