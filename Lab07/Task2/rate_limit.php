<?php
$log_file = 'requests.log';
$rate_limit = 5; 
$time_window = 60;
$user_ip = $_SERVER['REMOTE_ADDR'];
$current_time = time();

$logs = file_exists($log_file) ? file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

$v_logs = [];
$request_count = 0;
foreach ($logs as $log) {
    list($log_ip, $log_time) = explode('|', $log);
    if ($current_time - $log_time <= $time_window) {
        $v_logs[] = $log;
        if ($log_ip === $user_ip) {
            $request_count++;
        }
    }
}

if ($request_count >= $rate_limit) {
    http_response_code(429);
    echo "<h1>429 ERROR</h1>";
    echo "Забагато запитів. Спробуйте через $time_window секунд";
    exit;
}

$v_logs[] = "$user_ip|$current_time";
file_put_contents($log_file, implode("\n", $v_logs) . "\n");

http_response_code(200);
echo "<h1>200 Success</h1>";
echo "<p>Запит був оброблений успішно.</p>";

?>
