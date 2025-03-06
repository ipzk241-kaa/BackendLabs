<?php

class Circle {
    public $x;      
    public $y;      
    public $radius; 

    public function __construct($x, $y, $radius) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function __toString() {
        return "Коло з центром в ($this->x, $this->y) і радіусом $this->radius";
    }

    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function getY() {
        return $this->y;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getRadius() {
        return $this->radius;
    }

    public function setRadius($radius) {
        $this->radius = $radius;
    }

    public function checkIntersection(Circle $otherCircle) {
        $distance = sqrt(pow($this->x - $otherCircle->getX(), 2) + pow($this->y - $otherCircle->getY(), 2));
        return $distance <= ($this->radius + $otherCircle->getRadius());
    }
}
