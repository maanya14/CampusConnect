<?php
include "connection.php";

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

    // Validate password confirmation
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo "Passwords do not match!";
        exit;
    }

    // Validate enrollment number (only numbers)
    if (!preg_match("/^\d+$/", $enrollment)) {
        echo "Enrollment number should contain only numbers!";
        exit;
    }

    // Construct the query
    $query = "INSERT INTO students (name, enrollment, gsuitid, gender, dob, batch, branch, password) 
              VALUES ('$name', '$enrollment', '$gsuitid', '$gender', '$dob', '$batch', '$branch', '$password')";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        // Redirect to success page or show success message
        echo "Signup successful! Redirecting to login...";
        header("refresh:2; url=index.php");
    } else {
        // Display error message
        echo "Error: " . $conn->error;
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
    <style>
	/* General Styling */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    color: #8B4513; /* Dark brown text color for contrast */
    background-color: #fcf4e7; /* Main theme color */
}

.background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('background.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(5px);
    opacity: 0.2; /* Reduced opacity to blend with the theme color */
    z-index: -1;
}

header {
    text-align: center;
    padding: 20px 0;
}

#heading {
    font-size: 40px;
    margin: 0;
    color: #8B4513; /* Dark brown color for the heading */
}

main {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 100px);
}

.loginbox {
    width: 320px;
    background-color: #fff5e6; /* Lighter shade of the theme color */
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(139, 69, 19, 0.1);
}

.loginbox h2 {
    margin-top: 0;
    margin-bottom: 20px;
    color: #8B4513; /* Dark brown color for headings */
}

.loginbox input[type="text"],
.loginbox input[type="password"],
.loginbox input[type="email"],
.loginbox input[type="date"],
.loginbox select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #d2b48c; /* Light brown border */
    background-color: #fff;
    color: #8B4513;
    border-radius: 5px;
    box-sizing: border-box;
}

.loginbox input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    background-color: #52290d; /* Brown background */
    color: white;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.loginbox input[type="submit"]:hover {
    background-color: #8B4513; /* Darker brown on hover */
}

#password-form,
#success-message {
    display: none;
}

/* Placeholder text color */
::placeholder {
    color: #d2b48c; /* Light brown color for placeholder text */
}

/* Styling for the select dropdown */
select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%238B4513' viewBox='0 0 12 12'%3E%3Cpath d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
}

/* Styling for date input */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(48%) sepia(13%) saturate(3207%) hue-rotate(330deg) brightness(95%) contrast(80%);
}
</style>
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
            <form id="student-info-form"  method="POST">
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
<!-- 
	<script>
                    // Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get the form element
    const form = document.getElementById('student-info-form');

    // Add submit event listener to the form
    form.addEventListener('submit', function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get password fields
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        // Validate passwords match
        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return;
        }

        // Validate enrollment number (assuming it should only contain numbers)
        const enrollment = document.getElementById('enrollment').value;
        if (!/^\d+$/.test(enrollment)) {
            alert('Enrollment number should contain only numbers!');
            return;
        }

        // If all validations pass, create FormData object
        const formData = new FormData(form);

        // Send data to PHP using fetch
        fetch('signup.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Expecting JSON response
            })
            .then(data => {
                if (data.success) {
                    // Redirect to index.php on success
                    alert('Signup successful! Redirecting to login...');
                    window.location.href = 'index.php';
                } else {
                    // Display server error message
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
    });
});

	</script> -->

</body>
</html>
