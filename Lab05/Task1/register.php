<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Будь ласка, заповніть всі поля.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Паролі не співпадають.";
        exit;
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        echo "Користувач з таким логіном або email вже існує.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $hashed_password])) {
        echo "Реєстрація успішна! <a href='index.php'>Увійти</a>";
    } else {
        echo "Помилка реєстрації.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
</head>
<body>
    <h2>Реєстрація</h2>
    <form action="register.php" method="POST">
        <label for="username">Логін:</label>
        <input type="text" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        <br>
        <label for="confirm_password">Підтвердіть пароль:</label>
        <input type="password" name="confirm_password" required>
        <br>
        <button type="submit">Зареєструватися</button>
    </form>
</body>
</html>
