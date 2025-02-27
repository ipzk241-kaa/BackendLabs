<?php
$fontSize = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '16px';
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name']; 
        $fileName = $_FILES['image']['name']; 
        $fileSize = $_FILES['image']['size']; 
        $fileType = $_FILES['image']['type'];

        $maxFileSize = 2 * 1024 * 1024; 
        if ($fileSize > $maxFileSize) {
            $error = "Файл занадто великий. Максимальний розмір: 2 MB.";
        } else {
                $newFileName = uniqid('image_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destination = $uploadDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $destination)) {
                    $success = "Зображення успішно завантажено: <a href='$destination'>$newFileName</a>";
                } else {
                    $error = "Помилка при завантаженні зображення.";
                }
            }
    } else {
        $error = "Помилка: файл не був завантажений або сталася помилка.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завантаження зображень</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
        }
    </style>
</head>
<body>
    <h1>Завантажити зображення</h1>

    <?php if (isset($success)): ?>
        <div class="message success"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">Виберіть зображення:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <br>
        <button type="submit">Завантажити</button>
    </form>

    <h2>Завантажені зображення</h2>
    <?php
    if (is_dir($uploadDir)) {
        $files = scandir($uploadDir);
        echo "<ul>";
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                echo "<li><a href='$uploadDir$file'>$file</a></li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>Немає завантажених зображень.</p>";
    }
    ?>
</body>
</html>