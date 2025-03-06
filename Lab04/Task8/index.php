<?php

require_once 'Human.php';
require_once 'Student.php';
require_once 'Programmer.php';

$student = new Student(180, 90, 20, 'Житомирська політехніка', 2);

echo "Студент: <br>";
echo "Зріст: " . $student->getHeight() . " см<br>";
echo "Маса: " . $student->getWeight() . " кг<br>";
echo "Вік: " . $student->getAge() . " років<br>";
echo "Університет: " . $student->getUniversity() . "<br>";
echo "Курс: " . $student->getCourse() . "<br>";

$student->promote();
echo "Після переведення на новий курс: " . $student->getCourse() . "<br><br>";

$programmer = new Programmer(180, 75, 28, ['PHP', 'JavaScript'], 5);

echo "Програміст: <br>";
echo "Зріст: " . $programmer->getHeight() . " см<br>";
echo "Маса: " . $programmer->getWeight() . " кг<br>";
echo "Вік: " . $programmer->getAge() . " років<br>";
echo "Мови програмування: " . implode(', ', $programmer->getLanguages()) . "<br>";
echo "Досвід роботи: " . $programmer->getExperience() . " років<br>";

$programmer->addLanguage('Python');
echo "Мови програмування після додавання нової: " . implode(', ', $programmer->getLanguages()) . "<br>";
