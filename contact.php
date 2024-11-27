<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "campus_connect";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Prepare the SQL query
    $sql = "INSERT INTO `feedback` (email, name, message,created_at) VALUES ('$email', '$name', '$message',current_timestamp())";
    if (mysqli_query($conn, $sql)) {
        // Output success message to be shown in the front end
        echo "Thank you for your feedback!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
