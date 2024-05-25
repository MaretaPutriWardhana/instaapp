<?php
session_start();
include_once '../api/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $authController = new AuthController();
    $result = $authController->login($email, $password);

    if ($result['message'] === 'Login successful.') {
        $_SESSION['user_id'] = $result['user_id'];
        header("Location: post.php");
        exit();
    } else {
        echo json_encode($result);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
