// script1.js for marquee tag
const marquee = document.querySelector('.floating-headline marquee');
const messages = ["Welcome to CampusConnect!", "Empowering Students!", "Discover Opportunities!"];
let messageIndex = 0;

setInterval(() => {
    marquee.textContent = messages[messageIndex];
    messageIndex = (messageIndex + 1) % messages.length;}, 5000); // Changes every 3 seconds

    // script1.js for ContactUs
    function submitform(event) {
        // Prevent the default form submission behavior
        event.preventDefault();
        
        // Get the user input values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
    
        // Check if inputs are filled
        if (name === "" || email === "" || message === "") {
            alert('Please fill in all required fields.');
            return; // Prevent further execution if fields are empty
        }
    
        // Display a thank-you message
        const formContainer = document.getElementById('contactForm').parentElement;
        formContainer.innerHTML = '<p>Thank you for your message! We will get back to you soon.</p>';
        formContainer.querySelector('p').style.color = 'green';
    }
    


// FOR POSTS LIKE
// <?php 
// // Assuming a database connection is already established
// $user_id = $_POST['user_id']; // The logged-in user's ID
// $post_id = $_POST['post_id']; // The post's ID to like

// // Check if the user has already liked the post
// $query = "SELECT * FROM likes WHERE user_id = ? AND post_id = ?";
// $stmt = $conn->prepare($query);
// $stmt->bind_param("ii", $user_id, $post_id);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows === 0) {
//     // User hasn't liked the post yet
//     // Insert a new like
//     $insert_like = "INSERT INTO likes (user_id, post_id) VALUES (?, ?)";
//     $stmt = $conn->prepare($insert_like);
//     $stmt->bind_param("ii", $user_id, $post_id);
//     $stmt->execute();

//     // Update like_count in posts table
//     $update_likes = "UPDATE posts SET like_count = like_count + 1 WHERE post_id = ?";
//     $stmt = $conn->prepare($update_likes);
//     $stmt->bind_param("i", $post_id);
//     $stmt->execute();

//     echo json_encode(["status" => "liked", "like_count" => $stmt->affected_rows]);
// } else {
//     echo json_encode(["status" => "already liked"]);
// }
// ?>





//PHP TO UPDATE PHOTO ON POSTS
// <?php
// // Connect to the database
// include 'db_connection.php';

// $post_id = $_POST['post_id'];
// $title = $_POST['title'];
// $content = $_POST['content'];
// $image_path = "";

// // If a new image was uploaded, save it and update the image path
// if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
//     $target_dir = "uploads/"; // Directory to store images
//     $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
//     if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
//         $image_path = $target_file; // Update the path to the uploaded image
//     } else {
//         echo "Error uploading image.";
//         exit;
//     }
// }

// // Build the SQL update query
// $sql = "UPDATE posts SET title = ?, content = ?";
// $params = [$title, $content];

// if ($image_path) {
//     $sql .= ", image_path = ?";
//     $params[] = $image_path;
// }

// $sql .= " WHERE post_id = ?";
// $params[] = $post_id;

// // Prepare and execute the query
// $stmt = $conn->prepare($sql);
// $stmt->bind_param(str_repeat("s", count($params)), ...$params);

// if ($stmt->execute()) {
//     echo "Post updated successfully!";
// } else {
//     echo "Error updating post.";
// }
// ?>



//TO DISPLAY POSTS DYNAMICALLY
// <?php
// // Connect to the database
// include 'db_connection.php';

// $query = "SELECT * FROM posts";
// $result = $conn->query($query);

// while ($row = $result->fetch_assoc()) {
//     echo "<div class='post'>";
//     echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
//     echo "<p>" . htmlspecialchars($row['content']) . "</p>";
//     echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Post Image'>";
//     echo "</div>";
// }
// ?>
