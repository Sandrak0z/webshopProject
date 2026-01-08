<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");
include_once(__DIR__ . "/classes/Order.php");
include_once(__DIR__ . "/classes/User.php");

if (!isset($_SESSION['userId']) || empty($_SESSION['cart'])) {
    header("Location: login.php");
    exit();
}

$cart = $_SESSION['cart'];
$userId = $_SESSION['userId'];
$totalPrice = 0;
$itemsToSave = []; 

foreach ($cart as $details) {
    if (is_array($details)) {
        $pId = $details['productId'];
    } else {
        $pId = $details;
    }    $product = Product::getById($pId);
    
    if ($product) {
        $aantal = isset($details['quantity']) ? (int)$details['quantity'] : 1;
        $prijsPerStuk = (float)$product['Price'];

        if (isset($details['color'])) {
            $kleur = $details['color'];
        } else {
            $kleur = "Standaard";
        }

        if (isset($details['depth'])) {
            $diepte = $details['depth'];
        } else {
            $diepte = "Standaard";
        }

        $itemsToSave[] = [
            'productId' => $pId,
            'price'     => $prijsPerStuk,
            'color'     => $kleur,
            'depth'     => $diepte,
            'quantity'  => $aantal
        ];
        
        $totalPrice += ($prijsPerStuk * $aantal);
    }
}

$user = User::getById($userId);

if ($user['coins'] < $totalPrice) {
    header("Location: cart.php?error=payment_error");
    exit();
}

if (User::updateCoins($userId, $totalPrice * -1)) { 
    if (Order::save($userId, $itemsToSave, $totalPrice)) {
        $_SESSION['cart'] = []; 
        header("Location: profile.php?order=success");
        exit();
    } else {
        echo "Fout bij opslaan bestelling.";
    }
} else {
    echo "Fout bij betaling.";
}