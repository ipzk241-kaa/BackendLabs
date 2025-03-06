<?php

require_once 'Circle.php';

$circle = new Circle(3, 4, 5);

echo $circle . "<br>";

echo "Координата X: " . $circle->getX() . "<br>";
echo "Координата Y: " . $circle->getY() . "<br>";
echo "Радіус: " . $circle->getRadius() . "<br>";

$circle->setX(6);
$circle->setY(8);
$circle->setRadius(10);

echo "Оновлене коло: " . $circle . "<br>";

echo "Оновлена координата X: " . $circle->getX() . "<br>";
echo "Оновлена координата Y: " . $circle->getY() . "<br>";
echo "Оновлений радіус: " . $circle->getRadius() . "<br>";
