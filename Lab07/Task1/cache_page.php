<?php

$cache_file = 'cache.html';

ob_start();

$page_found = rand(0, 1);
if ($page_found && file_exists($cache_file)) {
    readfile($cache_file);
    exit;
}else if ($page_found) {
    http_response_code(200);
    echo "<h1>200 Success</h1>";
    echo "<p>Цей текст автоматично підставлений на сторінку.</p>";
} else {
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>Сторінку не знайдено на цьому серверу.</p>";
    if (file_exists($cache_file)) {
        unlink($cache_file);
    }
}

$page_content = ob_get_contents();
ob_end_flush();

if ($page_found) {
    file_put_contents($cache_file, $page_content);
}
