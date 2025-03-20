<?php
session_start();

if (isset($_SESSION['user_id'])) {
    echo "<h2>Вітаємо, " . htmlspecialchars($_SESSION['username']) . "!</h2>";
    echo "<a href='profile.php'>Редагувати профіль</a> | ";
    echo "<a href='logout.php'>Вийти</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
</head>
<body>
    <h2>Вхід на сайт</h2>
    <form action="login.php" method="POST">
        <label for="username">Логін:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Увійти</button>
    </form>
    <p>Ще не маєте акаунта? <a href="register.php">Зареєструватися</a></p>
</body>
</html>
