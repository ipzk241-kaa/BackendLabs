<?php
$fontSize = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        $error = "Будь ласка, заповніть всі поля.";
    } else {
        $folderName = $login;
        if (!is_dir($folderName)) {
            $error = "Папка з іменем '$folderName' не знайдена.";
        } else {
            $success = deleteFolder($folderName);
        }
    }
}
function deleteFolder($folder) {
    if (!is_dir($folder)) {
        return "Папка '$folder' не існує.";
    }
    $files = array_diff(scandir($folder), ['.', '..']);
    foreach ($files as $file) {
        $path = "$folder/$file";
        if (is_dir($path)) {
            deleteFolder($path);
        } else {
            unlink($path);
        }
    }
    if (rmdir($folder)) {
        return "Папка '$folder' та її вміст успішно видалені.";
    } else {
        return "Помилка при видаленні папки '$folder'.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення папки</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <h1>Видалення папки</h1>

    <?php if (isset($success)): ?>
        <div class="message success"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="login">Логін:</label>
        <input type="text" name="login" id="login" required>
        <br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Видалити папку</button>
    </form>
</body>
</html>