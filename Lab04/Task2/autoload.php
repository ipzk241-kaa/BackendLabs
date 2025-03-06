<?php

/**
 * Функція автопідключення класів.
 * Автоматично підключає клас на основі його імені.
 */
function myAutoloader($class) {
    include 'Models/UserModel.php';
    include 'Controllers/UserController.php';
    include 'Views/UserView.php';
}
spl_autoload_register('myAutoloader');
