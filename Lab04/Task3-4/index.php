<?php

require_once 'autoload.php';

use Controllers\UserController;
use Models\UserModel;
use Views\UserView;

$model = new UserModel();
$view = new UserView();
$controller = new UserController($model, $view);
$controller->displayUser();
