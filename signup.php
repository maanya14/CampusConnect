<?php
// Start the session
session_start();

// Database connection variables
$servername = "localhost";  // Database server
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "campus_connect"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request (form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get the personal information
    $name = $conn->real_escape_string($_POST['name']);
    $enrollment = $conn->real_escape_string($_POST['enrollment']);
    $gsuitid = $conn->real_escape_string($_POST['gsuitid']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $batch = $conn->real_escape_string($_POST['batch']);
    $branch = $conn->real_escape_string($_POST['branch']);
    
    // Get the password
    $password = $conn->real_escape_string($_POST['confirm_password']);
    
    // Password hashing for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the data into the database
    $sql = "INSERT INTO student (name, enrollment, gsuitid, gender, dob, batch, branch, password)
        VALUES ('$name', '$enrollment', '$gsuitid', '$gender', '$dob', '$batch', '$branch', '$hashed_password')";


    if ($conn->query($sql) === TRUE) {
        echo "success"; // Return success message to JavaScript
    } else {
        echo "error"; // Return error message to JavaScript
    }

    // Close the connection
    $conn->close();
}
?>
