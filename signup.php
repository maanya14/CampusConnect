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
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Password hashing for security
    

    // Insert the data into the database
    $sql = "INSERT INTO student (name, enrollment, gsuitid, gender, dob, batch, branch, password)
        VALUES ('$name', '$enrollment', '$gsuitid', '$gender', '$dob', '$batch', '$branch', '$hashedPassword')";


    if ($conn->query($sql) === TRUE) {
        echo "success"; // Return success message to JavaScript
    } else {
        echo "error"; // Return error message to JavaScript
    }

    // Close the connection
    $conn->close();
}
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
            <!-- Updated the form action to point to the PHP script -->
            <form id="student-info-form" action="pp.php" method="POST">
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

        <div class="loginbox" id="success-message" style="display: none;">
            <h2>Successfully Signed Up!</h2>
            <p>Redirecting to your home...</p>
        </div>
    </main>

    <script src="pp.js"></script>
</body>
</html>
