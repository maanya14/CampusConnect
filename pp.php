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
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            enrollment VARCHAR(50) NOT NULL UNIQUE,
            gsuitid VARCHAR(255) NOT NULL UNIQUE,
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
    $name = $_POST['name'];
    $enrollment = $_POST['enrollment'];
    $gsuitid = $_POST['gsuitid'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $batch = $_POST['batch'];
    $branch = $_POST['branch'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

    // Insert data into the table
    $stmt = $conn->prepare("INSERT INTO $tableName (name, enrollment, gsuitid, gender, dob, batch, branch, password) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $enrollment, $gsuitid, $gender, $dob, $batch, $branch, $password);

    if ($stmt->execute()) {
        echo "Record added successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
