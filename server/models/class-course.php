<?php

class Course {
    private $name;
    private $description;
    private $isUnderGraduate;
    private $faculty;
    private $isVirtual;

    public function __construct($name,$description,$isUnderGraduate,$faculty,$isVirtual) {
        $this->name = $name;
        $this->description = $description;
        $this->isUnderGraduate = $isUnderGraduate;
        $this->faculty = $faculty;
        $this->isVirtual = $isVirtual;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }
    public function getIsUnderGraduate() {
        return $this->isUnderGraduate;
    }
    public function getFaculty() {
        return $this->faculty;
    }
    public function getIsVirtual() {
        return $this->isVirtual;
    }

    public function __toString() {
        return 
        ' Name:' . $this->name . ", Description: " . $this->description . ", Pregrado? " . $this->isUnderGraduate . ", Facultad: " . $this->faculty . ", Virtual? " . $this->isVirtual;
    }
}

?>