<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['productId'])) {
        
        $productId = (int)$_POST['productId'];
        $quantity = (int)$_POST['quantity'];
        
        $color = "Standaard";
        if (isset($_POST['color'])) {
            $color = $_POST['color'];
        }

        $depth = "Standaard";
        if (isset($_POST['depth'])) {
            $depth = $_POST['depth'];
        }

        $cartKey = $productId . "_" . $color . "_" . $depth;
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['cart'][$cartKey])) {
            $_SESSION['cart'][$cartKey]['quantity'] = $_SESSION['cart'][$cartKey]['quantity'] + $quantity;
        } else {
            $item = array(
                "productId" => $productId,
                "quantity" => $quantity,
                "color" => $color,
                "depth" => $depth
            );
            $_SESSION['cart'][$cartKey] = $item;
        }
    }
}

header("Location: cart.php");
exit();