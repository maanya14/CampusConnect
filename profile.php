<?php
include 'connection.php';
session_start();


function getStudentInfo( $gsuite_id ) {
    global $host, $dbname, $username, $password;

    try {
        $pdo = new PDO( "mysql:host=$host;dbname=$dbname", $username, $password );
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $stmt = $pdo->prepare( 'SELECT * FROM students WHERE gsuit_id = :gsuit_id' );
        $stmt->execute( [ 'gsuit_id' => $gsuite_id ] );

        return $stmt->fetch( PDO::FETCH_ASSOC );
    } catch( PDOException $e ) {
        die( "Could not connect to the database $dbname :" . $e->getMessage() );
    }
}

// Check if GSuite ID is set in the session
if ( !isset( $_SESSION[ 'gsuite_id' ] ) ) {
    // Redirect to login page if GSuite ID is not set
    header( 'Location: login.php' );
    exit();
}

// Fetch student information using the GSuite ID from the session
$student = getStudentInfo( $_SESSION[ 'gsuite_id' ] );

// If student information is not found, handle the error
if ( !$student ) {
    die( 'Student information not found.' );
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StepUp | Campus Connect</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <a href="home.html"><img src="images/logo 5.jpg" alt="CampusConnect Logo" id="navlogo"></a>
            <span>Campus Connect</span>
        </div>
        <nav class="nav-links">
            <a href="2nd.html"><i class="fas fa-home"></i> Home</a>
            <a href="StepUpindex.html" class="active"><i class="fas fa-cogs"></i> StepUp</a>
            <a href="insights.html"><i class="fas fa-chart-line"></i> Insights</a>
            <a href="buzz.html"><i class="fas fa-bullhorn"></i> Buzz</a>
            <a href="pp.html"><i class="fas fa-user"></i> Profile</a>
        </nav>
        <div class="search">
            <input type="text" placeholder="Search" class="search-input">
            <button class="search-icon">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </header>
    <main class="container">
        <h1>Student Profile</h1>
        <div class="profile-card">
            <?php if ($student): ?>
            <div class="profile-header">
                <h2 id="student-name">
                    <?= htmlspecialchars($student['name']) ?>
                </h2>
                <p id="student-branch">
                    <?= htmlspecialchars($student['branch']) ?>
                </p>
            </div>
            <div class="profile-body">
                <div class="info-group">
                    <h3>Personal Information</h3>
                    <p><strong>Enrollment No:</strong>
                        <?= htmlspecialchars($student['enrollment_no']) ?>
                    </p>
                    <p><strong>Gender:</strong>
                        <?= htmlspecialchars($student['gender']) ?>
                    </p>
                    <p><strong>Date of Birth:</strong>
                        <?= htmlspecialchars($student['dob']) ?>
                    </p>
                </div>
                <div class="info-group">
                    <h3>Academic Information</h3>
                    <p><strong>Batch:</strong>
                        <?= htmlspecialchars($student['batch']) ?>
                    </p>
                    <p><strong>Branch:</strong>
                        <?= htmlspecialchars($student['branch']) ?>
                    </p>
                </div>
                <div class="info-group">
                    <h3>Contact Information</h3>
                    <p><strong>GSuit ID:</strong>
                        <?= htmlspecialchars($student['gsuit_id']) ?>
                    </p>
                </div>
            </div>
            <?php else: ?>
            <p>No student information found.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <p>&copy; 2023 Campus Connect. All rights reserved.</p>
            <p><a href="contact.html" target="_blank">Contact Us</a></p>
            <div class="social-links">
                <a href="https://www.facebook.com/jiitofficial/"><i class="fab fa-facebook"></i></a>
                <a href="https://x.com/JaypeeUniversi2"><i class="fab fa-twitter"></i></a>
                <a
                    href="https://www.linkedin.com/school/jaypee-institute-of-information-technology/posts/?feedView=all"><i
                        class="fab fa-linkedin"></i></a>
                <a href="https://www.instagram.com/jiit.official/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
    <script src="profile.js"></script>
</body>

</html>