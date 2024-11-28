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
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists, and create it if it doesn't
$dbCheckQuery = "SHOW DATABASES LIKE '$dbname'";
$result = $conn->query($dbCheckQuery);

if ($result->num_rows == 0) {
    // Database doesn't exist, create it
    $createDbQuery = "CREATE DATABASE $dbname";
    if ($conn->query($createDbQuery) === TRUE) {
        echo "Database '$dbname' created successfully.<br>";
    } else {
        die("Error creating database: " . $conn->error);
    }
} else {
    echo "Database '$dbname' already exists.<br>";
}

// Connect to the specific database
$conn->select_db($dbname);

// Check if the table exists, and create it if it doesn't
$tableName = "students";
$tableCheckQuery = "SHOW TABLES LIKE '$tableName'";
$result = $conn->query($tableCheckQuery);

if ($result->num_rows == 0) {
    // Table doesn't exist, create it
    $createTableQuery = "
        CREATE TABLE $tableName (
            name VARCHAR(255) NOT NULL,
            enrollment VARCHAR(50) NOT NULL UNIQUE,
            gsuitid VARCHAR(255) PRIMARY KEY,
            gender ENUM('male', 'female', 'other') NOT NULL,
            dob DATE NOT NULL,
            batch VARCHAR(50) NOT NULL,
            branch VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";

    if ($conn->query($createTableQuery) === TRUE) {
        echo "Table '$tableName' created successfully.<br>";
    } else {
        die("Error creating table: " . $conn->error);
    }
} else {
    echo "Table '$tableName' already exists.<br>";
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
    $query = "INSERT INTO $tableName (name, enrollment, gsuitid, gender, dob, batch, branch, password) 
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
