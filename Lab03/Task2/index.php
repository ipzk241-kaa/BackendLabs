<?php
session_start();
$fontSize = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
$correct_login = 'Admin';
$correct_password = 'password';

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login === $correct_login && $password === $correct_password) {
        $_SESSION['user'] = $login;
    } else {
        $error_message = "Невірний логін або пароль!";
    }
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма авторизації</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <h1>Добрий день, <?php echo $_SESSION['user']; ?>!</h1>
        <p>Ви успішно авторизувалися.</p>
        <a href="?logout=1">Вийти</a>
    <?php else: ?>
        <h1>Форма авторизації</h1>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="login">Логін:</label>
            <input type="text" name="login" id="login" required>
            <br>
            <br>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <button type="submit">Увійти</button>
        </form>
    <?php endif; ?>
</body>
</html>