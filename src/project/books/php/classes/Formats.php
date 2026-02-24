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
    public static function findByGame($gameId)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT p.*
            FROM platforms p
            INNER JOIN game_platform gp ON p.id = gp.platform_id
            WHERE gp.game_id = :game_id
            ORDER BY p.name
        ");
        $stmt->execute(['game_id' => $gameId]);

        $platforms = [];
        while ($row = $stmt->fetch()) {
            $platforms[] = new Formats($row);
        }

        return $platforms;
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
