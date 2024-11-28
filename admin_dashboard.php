<?php
session_start();

// Ensure the user is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_connect";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching posts from the database
$posts_query = "SELECT * FROM posts ORDER BY created_at DESC";
$posts_result = $conn->query($posts_query);

// Adding new post with image
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $tag = $conn->real_escape_string($_POST['tag']);

    // Handling image upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $image_path = $upload_dir . basename($_FILES['image']['name']);

        // Move uploaded file to the uploads directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $error_message = "Error uploading image.";
        }
    }

    // Insert post into the database
    $query = "INSERT INTO posts (title, content, tag, image_path, created_at) VALUES ('$title', '$content', '$tag', '$image_path', NOW())";
    if ($conn->query($query) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error_message = "Error adding post: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   <style>
.post-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background: #fff;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.post-header .post-tag {
    background-color: #007BFF;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    display: inline-block;
}

.post-image img {
    max-width: 100%;
    border-radius: 8px;
    margin: 10px 0;
}

.post-title {
    font-size: 18px;
    color: #333;
    margin: 0 0 10px;
}

.post-meta {
    color: #666;
    font-size: 14px;
}

.post-footer {
    margin-top: 10px;
    font-size: 12px;
    color: #999;
}

.delete-button {
    background-color: #FF4B4B;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}

</style>
</head>
<body>
    <header class="admin-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
        <a href="logout.php" class="logout-button">Logout</a>
    </header>

    <main class="admin-container">
        <section class="add-post-section">
            <h2>Add New Post</h2>
            <form method="POST" action="admin_dashboard.php" class="add-post-form" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Post Title" required>
                <textarea name="content" placeholder="Post Content" required></textarea>
                <input type="text" name="tag" placeholder="Post Tag (e.g., Amazon)" required>
                <input type="file" name="image" accept="image/*" required>
                <button type="submit" class="submit-button">Add Post</button>
            </form>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </section>

        <section class="manage-posts-section">
            <h2>Manage Posts</h2>
            <?php if ($posts_result->num_rows > 0): ?>
                <ul class="posts-list">
                    <?php while ($post = $posts_result->fetch_assoc()): ?>
                        <li class="post-item">
                            <div class="post-card">
                                <div class="post-header">
                                    <span class="post-tag"><?php echo htmlspecialchars($post['tag']); ?></span>
                                </div>
                                <div class="post-image">
                                    <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image">
                                </div>
                                <div class="post-body">
                                    <h3 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                                    <p class="post-meta"><?php echo htmlspecialchars($post['content']); ?></p>
                                </div>
                                <div class="post-footer">
                                    <span class="post-date"><?php echo htmlspecialchars($post['created_at']); ?></span>
                                    <form method="POST" action="delete_post.php">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No posts available.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
