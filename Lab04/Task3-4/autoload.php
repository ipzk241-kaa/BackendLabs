<?php

/**
 * Функція автозавантаження класів.
 * Вона перетворює неймспейси в шляхи файлів і підключає необхідний клас.
 */
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
