<?php

namespace Controllers;

use Models\UserModel;
use Views\UserView;

/**
 * Клас UserController відповідає за управління логікою і взаємодію з моделлю та видом.
 */
class UserController {
    private $model;
    private $view;

    /**
     * Конструктор ініціалізує об'єкти моделі та виду.
     */
    public function __construct(UserModel $model, UserView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    /**
     * Відображає дані користувача.
     */
    public function displayUser() {
        $userData = $this->model->getUserData();
        $this->view->render($userData);
    }
}
