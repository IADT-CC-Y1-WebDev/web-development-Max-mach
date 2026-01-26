<?php
class Student {
    protected $name;
    protected $number;
    public function __construct($name, $number) {
        $this->name = $name;
        $this->number = $number;
        if($number == ""){
            throw new Exception("Student number cannot be empty");
            
        }
         if($name == ""){
            throw new Exception("Student name cannot be empty");
            
        }
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        if($name == ""){
            throw new Exception("Student name cannot be empty");
            
        }
        return $this->name = $name;
    }
    public function getNumber() {
        return $this->number;
    }
    public function setNumber($number) {
        return $this->number = $number;
    }
}
?>