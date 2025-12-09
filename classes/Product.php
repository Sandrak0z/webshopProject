<?php
include_once(__DIR__ . "/Db.php");

class Product {
    public static function getAll(int $categoryId = 0): array {
        $conn = Db::getConnection();
        $sql = "SELECT * FROM Products";
        $array = [];

        if ($categoryId > 0) {
            $sql .= " WHERE CategoryId = :cat";
            $array[':cat'] = $categoryId;
        }

        $sql .= " ORDER BY ProductName";

        $stmt = $conn->prepare($sql);
        $stmt->execute($array);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
