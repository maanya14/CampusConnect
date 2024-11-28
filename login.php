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

    // Check if the user exists in the students table
    $query = "SELECT * FROM students WHERE gsuitid = '$email'"; // Fetch the user by email
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password against the stored hashed password
        if (password_verify($password, $user['password'])) {
            // Successful login
            header("Location: 2nd.html"); // Redirect to the second page on success
            exit();
        } else {
            // Invalid password
            header("Location: signup.php"); // Redirect to signup page if password doesn't match
            exit();
        }
    } else {
        // User not found
        header("Location: signup.php"); // Redirect to signup page if user doesn't exist
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="background"></div>
    <h1 id="heading">Campus Connect</h1>
 
    <!-- Form for login -->
    <form action="login.php" method="POST" onsubmit="return validateForm()">
        <div class="loginbox">
            <!-- Email field -->
            <input type="text" name="email" id="email" placeholder="Enter your email" required>
            <br>

            <!-- Password field -->
            <input type="password" name="password" id="password" placeholder="********" required>
            <br>

            <!-- Login button -->
            <input type="submit" name="submit" id="loginButton" value="Login">
            <br>

            <!-- SignUp button, handled by JavaScript -->
            <button type="button" name="signup" id="signupButton" onclick="window.location.href='signup.html'">Sign Up</button>
        </div>
    </form>

    <script>
        // JavaScript form validation function
        function validateForm() {
            var email = document.getElementById('email').value;

            // Check if the email is not empty and matches the required domain pattern
            var emailRegex = /^[a-zA-Z0-9._%+-]+@mail\.jiit\.ac\.in$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address ending with @mail.jiit.ac.in');
                return false; // Prevent form submission if the email is invalid
            }

            return true; // Allow form submission if validation passes
        }
    </script>
</body>
</html>
