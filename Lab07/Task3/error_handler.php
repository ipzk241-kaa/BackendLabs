<?php
ob_start();

register_shutdown_function(function () {
    $error = error_get_last();

    if ($error && ($error['type'] === E_ERROR || $error['type'] === E_CORE_ERROR || $error['type'] === E_COMPILE_ERROR)) {
        ob_clean(); 
        http_response_code(500);
        
        echo "<h1>500 Internal Server Error</h1>";
        echo "<p>ОЙ, сталася внутрішня помилка сервера :D.</p>";
        echo "<p>Ми працюємо над її виправленням(не працюємо нам лінь). Спробуйте знову через 30 хвилин(буде теж саме :D).</p>";
        exit;
    }
});

echo "<h1>200 Seccess</h1>";
echo "<p>Все працює.</p>";

ob_end_flush();

?>
