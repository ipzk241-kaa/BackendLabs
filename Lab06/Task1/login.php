<?php
require_once 'db.php';

$data = json_decode(file_get_contents("php://input"));
$email = $data->email;
$password = $data->password;

$query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$query->execute(['email' => $email]);
$user = $query->fetch();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        'success' => true,
        'user_id' => $user['id']
    ]);
} else {
    echo json_encode(['success' => false]);
}
?>
