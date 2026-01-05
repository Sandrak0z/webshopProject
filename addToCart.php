<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['productId'])) {
    $productId = intval($_POST['productId']);
    
    if (isset($_POST['quantity'])) {
        $quantity = intval($_POST['quantity']);
    } else {
        $quantity = 1;
    }
    
    if ($quantity < 1) { 
        $quantity = 1; 
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

header("Location: cart.php");
exit();