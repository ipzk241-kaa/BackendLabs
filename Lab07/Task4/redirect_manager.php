<?php
ob_start();
$redirects_file = 'redirects.json';

if (!file_exists($redirects_file)) {
    http_response_code(500);
    echo "<h1>500 Internal Server Error</h1>";
    echo "<p>Файл конфігурації не знайдено.</p>";
    exit;
}

$redirects = json_decode(file_get_contents($redirects_file), true);

if (!is_array($redirects)) {
    http_response_code(500);
    echo "<h1>500 Internal Server Error</h1>";
    echo "<p>Не правильний запит перенаправлення.</p>";
    exit;
}

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (array_key_exists($request_uri, $redirects)) {
    $destination = $redirects[$request_uri];

    if ($destination === "/404") {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "<p>Сторінку перенаправлення не знайдено.</p>";
    } else {
        header("Location: $destination", true, 301);
    }
    exit;
}

http_response_code(200);
echo "<h1>200 Seccess</h1>";
echo "<p>Немає запитів на перенаправлення.</p>";

ob_end_flush();

?>
