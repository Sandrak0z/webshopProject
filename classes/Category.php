<?php
include_once(__DIR__ . "/Db.php");

class Category {
    public static function getAll(): array {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT CategoryId, CategoryName FROM Categories ORDER BY CategoryName");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}