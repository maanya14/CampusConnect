<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $postId = intval($_POST['post_id']);
    
    $conn = new mysqli('localhost', 'root', '', 'campus_connect');
    
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    $query = "UPDATE posts SET likes = likes + 1 WHERE id = $postId";
    if ($conn->query($query) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }
    
    $conn->close();
}
?>
