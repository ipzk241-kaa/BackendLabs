<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $kol = $_POST['kol'];
    $info = $_POST['info'];

    $sql = "INSERT INTO tov (name, cost, kol, info) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $cost, $kol, $info]);

    echo "<div class='success'>Запис успішно додано!</div>";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати товар</title>
</head>
<body>
    <h1>Додати новий товар</h1>
    <form method="post" action="insert.php">
        <input type="text" name="name" placeholder="Назва товару" required><br>
        <input type="number" step="0.01" name="cost" placeholder="Ціна" required><br>
        <input type="number" name="kol" placeholder="Кількість" required><br>
        <textarea name="info" placeholder="Інформація про товар"></textarea><br>
        <input type="submit" value="Додати товар">
    </form>
</body>
</html>