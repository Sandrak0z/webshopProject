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
}