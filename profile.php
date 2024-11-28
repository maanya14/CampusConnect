<?php
session_start();

// Check if the user is logged in by verifying if an gsuitid is stored in the session
if (!isset($_SESSION['gsuitid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "campus_connect");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the gsuitid from the session
$gsuitid = $_SESSION['gsuitid'];

// Query to get student data based on gsuitid
$query = "SELECT * FROM students WHERE gsuitid = '$gsuitid'";
$result = mysqli_query($conn, $query);

$student = null;
if (mysqli_num_rows($result) > 0) {
    $student = mysqli_fetch_assoc($result);
}

mysqli_close($conn);
?>

