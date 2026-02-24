<?php
class Publisher
{
    public $id;
    public $name;
    private $db;

    public function __construct($data = [])
    {
        $this->db = DB::getInstance()->getConnection();
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
    }

    // Get all publishers
    public static function findAll()
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers ORDER BY name");
        $stmt->execute();

        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }

        return $publishers;
    }

    // Convert to array (optional, for JSON or debugging)
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}