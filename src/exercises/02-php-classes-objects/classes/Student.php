<?php
        class Student {
            public $name;
            public $number;
            public function __construct($name, $number) {
                $this->name = $name;
                $this->number = $number;
            }
            public function getName($name) {
                return $this->name = $name;
            }
             public function getNumber($number) {
                return $this->number = $number;
            }
        }
        ?>