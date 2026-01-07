<?php
include_once(__DIR__ . "/Db.php");

class Order {
    public static function save($userId, $items, $totalPrice) {
        $conn = Db::getConnection();
        
        try {
            $stmt = $conn->prepare("INSERT INTO Orders (userId, totalPrice, orderDate) VALUES (:uid, :total, NOW())");
            $stmt->execute([
                ':uid' => $userId,
                ':total' => $totalPrice
            ]);
            
            $orderId = $conn->lastInsertId();

            foreach ($items as $item) {
                $stmtItem = $conn->prepare("INSERT INTO order_items (orderId, productId, Price, color, depth, quantity) 
                                         VALUES (:oid, :pid, :price, :color, :depth, :qty)");
                $stmtItem->execute([
                    ':oid' => $orderId,
                    ':pid' => $item['productId'],
                    ':price' => $item['price'],
                    ':color' => $item['color'],
                    ':depth' => $item['depth'],
                    ':qty' => $item['quantity']
                ]);
            }
            return true;

        } catch (Exception $e) {
            echo "Fout bij opslaan: " . $e->getMessage();
            return false;
        } 
    } 
    public static function getHistory($userId) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM Orders WHERE userId = :uid ORDER BY orderDate DESC");
        $stmt->execute([':uid' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getItemsByOrderId($orderId) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare("
            SELECT order_items.*, Products.ProductName, Products.Image 
            FROM order_items 
            JOIN Products ON order_items.productId = Products.ProductId
            WHERE order_items.orderId = :oid
        ");
        $stmt->execute([':oid' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 