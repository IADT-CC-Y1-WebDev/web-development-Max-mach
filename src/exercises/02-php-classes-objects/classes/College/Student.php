<?php
namespace College;
// spl_autoload_register(function ($class) {
//     $path = str_replace("\\", DIRECTORY_SEPARATOR, $class);
//     $file = __DIR__ . '/../class/../College' . $path . '.php';
//     if (file_exists($file)) {
//         require_once $file;
//     }
// });
class Student
{
    protected $name;
    protected $number;
    private static $students = [];
    // private static $count = 0;
    public function __construct($name, $number)
    {
        // echo"Creating student: $name" . "<br>";
        if ($number == "") {
            throw new Exception("Student number cannot be empty");

        }
        if ($name == "") {
            throw new Exception("Student name cannot be empty");

        }
        // self::$count++;
        $this->name = $name;
        $this->number = $number;
        self::$students[$number] = $this;


    }

    public static function getCount()
    {
        // return self::$count;
        return count(self::$students);
    }
    public static function findAll()
    {
        return self::$students;
    }
    public function leave()
    {
        unset(self::$students[$this->number]);
    }
    public static function findByNumber($namber)
    {
        if ($namber != null) {
            return self::$students[$namber];
        }

    }
    public function __toString()
    {
        $format = "Student: %s, Number %s" . "<br>";
        return sprintf($format, $this->name, $this->number);
    }
    public function __destruct()
    {
        echo "Student {$this->name} has left the system" . "<br>";
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        if ($name == "") {
            throw new Exception("Student name cannot be empty");

        }
        return $this->name = $name;
    }
    public function getNumber()
    {
        return $this->number;
    }
    public function setNumber($number)
    {
        return $this->number = $number;
    }
}
?>