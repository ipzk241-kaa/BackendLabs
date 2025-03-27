<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id']) && !empty($data['title']) && !empty($data['content'])) {
    $stmt = $pdo->prepare("UPDATE notes SET title = :title, content = :content WHERE id = :id");
    $stmt->execute([
        ':id' => $data['id'],
        ':title' => $data['title'],
        ':content' => $data['content']
    ]);

    echo json_encode(["message" => "Замітка оновлена"]);
} else {
    echo json_encode(["error" => "Усі поля обов'язкові"]);
}
?>
