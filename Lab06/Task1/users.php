<?php
require 'db.php';

$stmt = $pdo->query("SELECT id, name, email FROM users");
$users = $stmt->fetchAll();

echo json_encode($users);
?>
