<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_connect";

// Create connection to MySQL server (without specifying database initially)
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $enrollment = $conn->real_escape_string($_POST['enrollment']);
    $gsuitid = $conn->real_escape_string($_POST['gsuitid']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $batch = $conn->real_escape_string($_POST['batch']);
    $branch = $conn->real_escape_string($_POST['branch']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

    // Construct the query
    $query = "INSERT INTO student (name, enrollment, gsuitid, gender, dob, batch, branch, password) 
              VALUES ('$name', '$enrollment', '$gsuitid', '$gender', '$dob', '$batch', '$branch', '$password')";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        echo "Record added successfully.<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

// Close the database connection
$conn->close();
?>
