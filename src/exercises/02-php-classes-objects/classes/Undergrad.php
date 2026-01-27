  <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Undergrad.php';
        require_once __DIR__ .'/Student.php';
        class SavingsAccount  extends Student{
            protected $course;
            protected $year;
            public function __construct($name, $number, $course, $year){
                parent::__construct($name, $number);
                $this-> year = $year;
                $this-> course = $course;
        }
        public function  __toString(){
            return"Undergrad: $this->name ($this->number), [$this->course], Year $this->year";
        }
        public function getYear(){
            return $this->year;
        }
        public function getCourse(){
            return $this->course;
        }
    }
        ?>