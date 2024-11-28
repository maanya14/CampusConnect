<?php
// Start the session
session_start();

// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_connect";

// Default admin credentials
$default_admin_email = "admin@mail.jiit.ac.in";
$default_admin_password = "admin123"; // Hardcoded admin credentials

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize the email and password from the POST data
    $email = $conn->real_escape_string(trim($_POST['email']));
    $user_password = $conn->real_escape_string(trim($_POST['password']));

    // Check if the credentials match the default admin credentials
    if ($email === $default_admin_email && $user_password === $default_admin_password) {
        // Set session variables for the admin
        $_SESSION['email'] = $default_admin_email;
        $_SESSION['name'] = 'Admin'; // Display name for the admin

        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    }

    // Query to check if the email exists in the database for regular users
    $sql = "SELECT * FROM student WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $user = $result->fetch_assoc();

        // Verify the password (assuming it's hashed in the database)
        if (password_verify($user_password, $user['password'])) {
            // Successful login, set session variables
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name']; // Optional: store the user's name

            // Redirect to student page (2nd.html)
            header("Location: 2nd.html");
            exit();
        } else {
            // Incorrect password
            $error_message = "Invalid email or password.";
        }
    } else {
        // No user found with the given email, redirect to signup page
        header("Location: pp.html"); // Replace with your signup page
        exit();
    }
}

// Close the connection
$conn->close();
?>










