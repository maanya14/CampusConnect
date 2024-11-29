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
        // Redirect to login.php after successful signup
        header("Location: login.php");
        exit(); // Ensure no further code executes
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect - Student Signup</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="background"></div>
    <header>
        <h1 id="heading">Campus Connect</h1>
    </header>

    <main>
        <div class="loginbox" id="signup-form">
            <h2>Student Signup</h2>
            <form id="student-info-form" action="" method="POST">
                <input type="text" name="name" id="name" placeholder="Name" required>
                <input type="text" name="enrollment" id="enrollment" placeholder="Enrollment No." required>
                <input type="email" name="gsuitid" id="gsuitid" placeholder="GSuit ID" required>
                <select name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <input type="date" name="dob" id="dob" required>
                <input type="text" name="batch" id="batch" placeholder="Batch" required>
                <input type="text" name="branch" id="branch" placeholder="Branch" required>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" name="submit" value="Sign Up">
            </form>
        </div>
    </main>
	<script>
    		document.getElementById('student-info-form').addEventListener('submit', function (event) {
        	const password = document.getElementById('password').value;
        	const confirmPassword = document.getElementById('confirm-password').value;

        	if (password !== confirmPassword) {
           	 alert('Passwords do not match!');
           	 event.preventDefault(); // Prevent the form from submitting
        	}
   	 });
	</script>

</body>
</html>
