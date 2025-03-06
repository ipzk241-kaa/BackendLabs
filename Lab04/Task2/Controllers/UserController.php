<?php

/**
 * Клас UserController відповідає за управління логікою і взаємодію з моделлю та видом.
 */
class UserController {
    private $model;
    private $view;

    /**
     * Конструктор ініціалізує об'єкти моделі та виду.
     */
    public function __construct() {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    /**
     * Відображає дані користувача.
     */
    public function displayUser() {
        $userData = $this->model->getUserData();
        $this->view->render($userData);
    }
}
