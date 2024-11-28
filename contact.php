<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_connect";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Capture form data and sanitize it
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validate fields
    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: contact.php");
        exit();
    }

    // Prepare SQL query to insert data into the feedback table
    $sql = "INSERT INTO feedback (email, name, message, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $name, $message);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['success'] = "Your feedback has been successfully uploaded to our servers—and our hearts. 💾❤️";
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }

    $stmt->close();

    // Redirect back to the contact form with a success message
    header("Location: contact.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css"> 
    <style>
        /* Hide the form when success message is displayed */
        #contactForm.hidden {
            display: none;
        }
    </style>
</head>
<body>
<header>
        <h1>Contact Us</h1>
    </header>
    <main>
        <?php
        // Display success or error messages
        if (isset($_SESSION['success'])) {
            echo '<div id="feedbackMessage" class="feedback" style="display: block;">
                    <p>' . htmlspecialchars($_SESSION['success']) . '</p>
                  </div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div id="errorMessage" class="error" style="display: block; color: red;">
                    <p>' . htmlspecialchars($_SESSION['error']) . '</p>
                  </div>';
            unset($_SESSION['error']);
        }
        ?>

        <!-- Contact Form (Hidden After Success) -->
        <form id="contactForm" action="contact.php" method="POST" class="<?php echo isset($_SESSION['success']) ? 'hidden' : ''; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            
            <button type="submit" name="submit">Send</button>
        </form>
    </main>
</body>
</html>
