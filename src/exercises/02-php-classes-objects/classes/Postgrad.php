 <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Undergrad.php';
        require_once __DIR__ .'/Student.php';
        class postograf  extends Student{
            protected $supervisor ;
            protected $topic ;
            public function __construct($name, $number, $supervisor, $topic){
                parent::__construct($name, $number);
                $this->supervisor = $supervisor;
                $this->topic = $topic;
            }
            public function getSupervisor(){
                return $this->supervisor;
            }
            public function getTopic(){
                return $this->topic;
            }
        }
        ?>