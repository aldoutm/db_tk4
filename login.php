<?php
session_start();
require 'models/Pengguna.php';  
$dbConnection = new PDO('mysql:host=localhost;dbname=yourdbname', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $penggunaModel = new Pengguna($dbConnection);
    $user = $penggunaModel->checkCredentials($username, $password);

    if ($user) {
        $_SESSION['user'] = $user['NamaPengguna'];
        $_SESSION['role'] = $user['role'];  
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

