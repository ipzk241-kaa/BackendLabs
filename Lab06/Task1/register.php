<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["error" => "Невірний запит"]);
    exit;
}

$name = trim($data['name']);
$email = trim($data['email']);
$password = $data['password'];

if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(["error" => "Заповніть всі поля"]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(["error" => "Пароль має бути не менше 6 символів"]);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo json_encode(["error" => "Email вже використовується"]);
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
if ($stmt->execute([$name, $email, $hashed_password])) {
    echo json_encode(["success" => "Користувач зареєстрований"]);
} else {
    echo json_encode(["error" => "Помилка реєстрації"]);
}
?>
