<?php
session_start();
include_once '../api/controllers/PostController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$postController = new PostController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];

    $result = $postController->createPost($user_id, $content, $image_url);
    echo json_encode($result);
}

$posts = $postController->getPosts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="post.php">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <label for="content">Content:</label>
            <input type="text" name="content" required>
            <br>
            <label for="image_url">Image URL:</label>
            <input type="text" name="image_url" required>
            <br>
            <button type="submit">Post</button>
        </form>

        <h2>All Posts</h2>
        <?php foreach ($posts as $post) : ?>
            <div>
                <h3><?php echo $post['content']; ?></h3>
                <img src="<?php echo $post['image_url']; ?>" alt="Post Image" width="200">
                <p>Posted by User ID: <?php echo $post['user_id']; ?> on <?php echo $post['created_at']; ?></p>
            </div>
        <?php endforeach; ?>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
