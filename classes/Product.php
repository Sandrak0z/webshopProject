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
    public static function getById(int $id): ?array
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("
            SELECT * 
            FROM Products 
            WHERE ProductId = :id
            LIMIT 1
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            $product['depths'] = !empty($product['DepthOptions']) ? explode(',', $product['DepthOptions']) : [];
            $product['colors'] = !empty($product['ColorOptions']) ? explode(',', $product['ColorOptions']) : [];
        }
        return $product;
        
    }

    public static function getDepthOptions(int $productId): array
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("
            SELECT Depth 
            FROM product_depths 
            WHERE ProductId = :id
            ORDER BY Depth
        ");

        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getColors(int $productId): array
    {
        $conn = Db::getConnection();

        $stmt = $conn->prepare("
            SELECT ColorName, ColorClass 
            FROM product_colors 
            WHERE ProductId = :id
        ");

        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getCartDetails(array $ids): array {
        if (empty($ids)) {
            return array();
        } else {
            $conn = Db::getConnection();
    
            $vraagtekens = "";
            $teller = 0;
    
            foreach ($ids as $id) {
                if ($teller == 0) {
                    $vraagtekens = $vraagtekens . "?";
                } else {
                    $vraagtekens = $vraagtekens . ",?";
                }
                $teller = $teller + 1;
            }
    
            $sql = "SELECT * FROM Products WHERE ProductId IN (" . $vraagtekens . ")";
            $stmt = $conn->prepare($sql);
    
            $stmt->execute(array_values($ids)); 
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
