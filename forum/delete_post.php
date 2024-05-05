<?php
include_once '.\headFoot\header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID of the post to be deleted
    $post_id = $_POST['post_id'];

    // Delete the post from the database
    $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $post_id, $_SESSION['id']);
    $stmt->execute();

    // Redirect the user back to the forum
    header('Location: forum.php');
    exit();
}