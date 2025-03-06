<?php

namespace Views;

/**
 * Клас UserView відповідає за виведення даних користувача на екран.
 */
class UserView {
    /**
     * Виводить дані на екран.
     *
     * @param string $data Дані, які необхідно відобразити.
     */
    public function render($data) {
        echo "Displaying: " . $data;
    }
}
