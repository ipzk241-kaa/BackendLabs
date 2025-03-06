<?php

require_once 'Circle.php';

$circle1 = new Circle(3, 4, 5); 
$circle2 = new Circle(7, 8, 5); 
$circle3 = new Circle(15, 15, 5); 

if ($circle1->checkIntersection($circle2)) {
    echo "Кола 1 і 2 перетинаються.<br>";
} else {
    echo "Кола 1 і 2 не перетинаються.<br>";
}

if ($circle1->checkIntersection($circle3)) {
    echo "Кола 1 і 3 перетинаються.<br>";
} else {
    echo "Кола 1 і 3 не перетинаються.<br>";
}
