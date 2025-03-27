<?php

$pdo = new PDO("mysql:host=localhost;dbname=traffic_logs;charset=utf8", "root", "");

$ip = $_SERVER['REMOTE_ADDR'];
$url = $_SERVER['REQUEST_URI'];
$status = http_response_code() ?: 200;

$stmt = $pdo->prepare("INSERT INTO requests (ip_address, request_time, request_url, status_code) VALUES (?, NOW(), ?, ?)");
$stmt->execute([$ip, $url, $status]);

?>
