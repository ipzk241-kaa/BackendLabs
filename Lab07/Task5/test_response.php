<?php

require_once "Response.php";

// $response = new Response();
// $response->setStatus(200);
// $response->addHeader("Content-Type: text/html; charset=UTF-8");
// $response->send("<h1>200 Seccess</h1><p>Сторінка успішно відображена</p>");


$response = new Response();
$response->setStatus(404);
$response->addHeader("Content-Type: text/html; charset=UTF-8");
$response->send("<h1>404 Error</h1><p>Сторінку не знайдено.</p>");

?>
