<?php

class Student extends Human {
    private $university; 
    private $course;     

    public function __construct($height, $weight, $age, $university, $course) {
        parent::__construct($height, $weight, $age);
        $this->university = $university;
        $this->course = $course;
    }

    public function getUniversity() {
        return $this->university;
    }

    public function setUniversity($university) {
        $this->university = $university;
    }

    public function getCourse() {
        return $this->course;
    }

    public function setCourse($course) {
        $this->course = $course;
    }
    public function cleanRoom() {
        echo "Студент прибирає кімнату.<br>";
    }

    public function cleanKitchen() {
        echo "Студент прибирає кухню.<br>";
    }
}
