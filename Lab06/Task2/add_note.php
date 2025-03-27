<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['title']) && !empty($data['content'])) {
    $stmt = $pdo->prepare("INSERT INTO notes (title, content) VALUES (:title, :content)");
    $stmt->execute([
        ':title' => $data['title'],
        ':content' => $data['content']
    ]);

    echo json_encode(["message" => "Замітка додана"]);
} else {
    echo json_encode(["error" => "Всі поля обов'язкові"]);
}
?>
