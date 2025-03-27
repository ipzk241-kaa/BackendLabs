<?php

$pdo = new PDO("mysql:host=localhost;dbname=traffic_logs;charset=utf8", "root", "");

$queryTotal = $pdo->query("SELECT COUNT(*) FROM requests WHERE request_time >= NOW() - INTERVAL 1 DAY");
$totalRequests = $queryTotal->fetchColumn();

$query404 = $pdo->query("SELECT COUNT(*) FROM requests WHERE status_code = 404 AND request_time >= NOW() - INTERVAL 1 DAY");
$error404Count = $query404->fetchColumn();

$percentage404 = $totalRequests > 0 ? ($error404Count / $totalRequests) * 100 : 0;

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика трафіку</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .warning { background-color: #ffdddd; border-left: 6px solid #ff4444; padding: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <h1>Статистика трафіку</h1>
    <p>Всього запитів за добу: <strong><?php echo $totalRequests; ?></strong></p>
    <p>404 помилок: <strong><?php echo $error404Count; ?></strong></p>
    <p>Відсоток 404 помилок: <strong><?php echo number_format($percentage404, 2); ?>%</strong></p>

    <?php if ($percentage404 > 10): ?>
        <div class="warning">
            <h2>⚠ Увага! Високий рівень 404 помилок</h2>
            <p>За останню добу кількість 404 помилок перевищила <strong>10%</strong> від загальної кількості запитів.</p>
            <p>Перевірте систему на наявність відсутніх сторінок або неправильно налаштованих редиректів.</p>
        </div>
    <?php endif; ?>
</body>
</html>

