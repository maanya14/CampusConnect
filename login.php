<?php
// Start the session
session_start();

// Database connection variables
$servername = "localhost";  // Database server (usually localhost)
$username = "root";         // Database username (default is root)
$password = "";             // Database password (usually empty in local development)
$dbname = "campus_connect"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the POST data
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Sanitize the email to prevent SQL Injection
    $email = $conn->real_escape_string($email);
    $user_password = $conn->real_escape_string($user_password);

    // Query to check if the email exists and the password matches
    $sql = "SELECT * FROM alldetails WHERE email = '$email' AND password = '$user_password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // User exists, login is successful
        $_SESSION['email'] = $email;  // Store the email in the session
        // Redirect to a dashboard or home page
        header("Location: dashboard.php");
        exit();
    } else {
        // User doesn't exist or incorrect credentials
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}

// Close the connection
$conn->close();
?>
