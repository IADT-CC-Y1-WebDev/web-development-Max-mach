<?php

class BookPlatform
{
    // Check if a relationship exists
    public static function exists($bookID, $formatID)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT COUNT(*) as count
            FROM book_format
            WHERE book_id = :book_id AND format_id = :format_id
        ");
        $stmt->execute([
            'book_id' => $bookID,
            'format_id' => $formatID
        ]);

        $row = $stmt->fetch();
        return $row['count'] > 0;
    }

    // Create a new game-platform relationship
    public static function create($bookID, $formatID)
    {
        // Check if relationship already exists
        if (self::exists($bookID, $formatID)) {
            return false;
        }

        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO book_format (book_id, format_id)
            VALUES (:book_id, :format_id)
        ");

        return $stmt->execute([
            'book_id' => $bookID,
            'format_id' => $formatID
        ]);
    }

    // Delete a specific game-platform relationship
    public static function remove($bookID, $formatID)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM book_format
            WHERE book_id = :book_id AND format_id = :format_id
        ");

        return $stmt->execute([
            'book_id' => $bookID,
            'format_id' => $formatID
        ]);
    }

    // Delete all platform relationships for a specific game
    public static function deleteByBook($gameId)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM book_format
            WHERE book_id = :book_id
        ");
        return $stmt->execute(['book_id' => $gameId]);
    }
}
