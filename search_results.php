<?php
include 'connection.php';

// Get the search query from the GET request
$search_query = isset( $_GET[ 'q' ] ) ? trim( $_GET[ 'q' ] ) : '';

// Escape the search query to prevent SQL injection
$search_query = $conn->real_escape_string( $search_query );

// Query to search posts by title, tag, or meta information
$sql = "SELECT * FROM posts 
        WHERE post_title LIKE '%$search_query%' 
        OR post_tag LIKE '%$search_query%' 
        OR post_meta LIKE '%$search_query%'";

$result = $conn->query( $sql );
?>

<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<title>Search Results - StepUp</title>
<link rel = 'stylesheet' href = 'StepUp.css'>
<link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
</head>
<body>
<header>
<nav class = 'navbar'>
<div class = 'logo'>
<a href = 'home.html'><img src = 'images/logo 5.jpg' alt = 'CampusConnect Logo' id = 'navlogo'></a>
</div>
<div class = 'nav-links'>
<a href = '2nd.html'>Home</a>
<a href = 'StepUpindex.html' class = 'active'>StepUp</a>
<a href = 'insights.html'>Insights</a>
<a href = 'buzz.html'>Buzz</a>
<a href = 'pp.html'>Profile</a>
</div>
<div class = 'search'>
<form action = 'search_results.php' method = 'GET'>
<input type = 'text' name = 'q' placeholder = 'Search' class = 'search-input' id = 'searchInput'>
<button type = 'submit' class = 'search-icon'>
<i class = 'fa fa-search'></i>
</button>
</form>
</div>
</nav>
</header>

<main>
<h1>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h1>

<div class = 'post-grid'>
<?php
if ( $result->num_rows > 0 ) {
    // Display each post
    while ( $row = $result->fetch_assoc() ) {
        echo '<div class="post-card">';
        echo '<div class="post-header"><span class="post-tag">' . htmlspecialchars( $row[ 'post_tag' ] ) . '</span></div>';
        echo '<div class="post-image"><img src="' . htmlspecialchars( $row[ 'post_image_url' ] ) . '" alt="' . htmlspecialchars( $row[ 'post_title' ] ) . '"></div>';
        echo '<div class="post-body">';
        echo '<h3 class="post-title">' . htmlspecialchars( $row[ 'post_title' ] ) . '</h3>';
        echo '<p class="post-meta">' . htmlspecialchars( $row[ 'post_meta' ] ) . '</p>';
        echo '</div>';
        echo '<div class="post-footer">';
        echo '<span class="post-date">' . htmlspecialchars( $row[ 'post_date' ] ) . '</span>';
        echo '<button class="like-button"><i class="fa fa-heart"></i> <span class="like-count">' . htmlspecialchars( $row[ 'likes_count' ] ) . '</span></button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No results found for your search.</p>';
}

$conn->close();
?>
</div>
</main>

<footer>
<div class = 'footer-content'>
<p>Webpage Designed by Maanya and Team</p>
<p><button onclick = 'openContactUs(event)'>Contact Us</button></p>
<div class = 'social-links'>
<a href = 'https://www.facebook.com/jiitofficial/'><i class = 'fab fa-facebook'></i></a>
<a href = 'https://x.com/JaypeeUniversi2'><i class = 'fab fa-twitter'></i></a>
<a href = 'https://www.linkedin.com/school/jaypee-institute-of-information-technology/posts/?feedView=all'><i class = 'fab fa-linkedin'></i></a>
<a href = 'https://www.instagram.com/jiit.official/'><i class = 'fab fa-instagram'></i></a>
</div>
</div>
</footer>

</body>
</html>