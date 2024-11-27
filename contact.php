<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "campus_connect";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    $sql = "INSERT INTO `feedback` (`name`, `email`, `message`) VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<div class="feedback"><p>Your feedback has been successfully uploaded to our servers—and our hearts. 💾❤️</p></div>";
    } else {
        echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
