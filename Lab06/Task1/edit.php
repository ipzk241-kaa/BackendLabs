<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id'], $data['name'], $data['email'])) {
        echo json_encode(['error' => 'Недостатньо даних']);
        exit;
    }

    $id = (int)$data['id'];
    $name = $data['name'];
    $email = $data['email'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $id]);

        echo json_encode(['success' => 'Дані користувача успішно оновлені']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Помилка при оновленні даних']);
    }
}
?>
