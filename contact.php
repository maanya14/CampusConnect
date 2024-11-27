<?php
$servername="localhost";
$username="root";
$password=" ";
$dbname="feedback";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql= INSERt INTO feedback(name,email,message) values($name,$email,$message);
    $result=mysqli_query($conn,$sql);
    echo "Your feedback has been successfully uploaded to our servers—and our hearts. 💾❤️";
}
?>
