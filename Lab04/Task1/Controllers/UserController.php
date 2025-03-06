<?php

require_once 'Models/UserModel.php';
require_once 'Views/UserView.php';

class UserController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    public function displayUser() {
        $userData = $this->model->getUserData();
        $this->view->render($userData);
    }
}
