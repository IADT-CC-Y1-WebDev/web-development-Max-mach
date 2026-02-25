<?php

class Formats
{
    public $id;
    public $name;

    private $db;

    public function __construct($data = [])
    {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
        }
    }

    // Find all platforms
    public static function findAll()
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats ORDER BY name");
        $stmt->execute();

        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Formats($row);
        }

        return $formats;
    }

    // Find platform by ID
    public static function findById($id)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Formats($row);
        }

        return null;
    }

    // Find platforms by game (requires JOIN with game_platform table)
    public static function findByBook($bookID)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT p.*
            FROM formats p
            INNER JOIN book_format gp ON p.id = gp.format_id
            WHERE gp.book_id = :book_id
            ORDER BY p.name
        ");
        $stmt->execute(['book_id' => $bookID]);

        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Formats($row);
        }

        return $formats;
    }

    // Convert to array for JSON output
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
