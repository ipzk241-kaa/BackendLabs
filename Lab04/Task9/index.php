<?php

require_once 'Human.php';
require_once 'Student.php';
require_once 'Programmer.php';

$student = new Student(170, 60, 20, 'Київський університет', 1);

echo "Для студента:<br>";
$student->birthChild(); 

echo "<br>";

$programmer = new Programmer(180, 75, 28, ['PHP', 'JavaScript'], 5);

echo "Для програміста:<br>";
$programmer->birthChild(); 
