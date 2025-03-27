<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id'])) {
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = :id");
    $stmt->execute([':id' => $data['id']]);

    echo json_encode(["message" => "Замітка видалена"]);
} else {
    echo json_encode(["error" => "Некоректний ID"]);
}
?>
