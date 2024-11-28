<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_connect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check if it's an admin account
    if ($email === 'admin@mail.jiit.ac.in' && $password === 'admin_password') {
        header("Location: admin-dashboard.html");
        exit();
    }

    // Check if the user exists in the students table
    $query = "SELECT * FROM students WHERE gsuitid = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Successful login
            header("Location: 2nd.html");
            exit();
        } else {
            // Invalid password
            header("Location: pp.html");
            exit();
        }
    } else {
        // User not found
        header("Location: pp.html");
        exit();
    }
}

$conn->close();
?>











