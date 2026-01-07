<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$cart = $_SESSION['cart'];
$userId = $_SESSION['userId'];
$totalPrice = 0;
$itemsToSave = array(); 

foreach ($cart as $key => $details) {
    if (is_array($details)) {
        $pId = $details['productId'];
    } else {
        $pId = $details;
    }

    $product = Product::getById($pId);
    
    if ($product != null) {
        $prijsPerStuk = $product['Price'];
        
        $kleur = "Standaard";
        $diepte = "Standaard";
        $aantal = 1;

        if (is_array($details)) {
            $kleur = $details['color'];
            $diepte = $details['depth'];
            $aantal = $details['quantity'];
        }

        $newItem = array(
            'productId' => $pId,
            'price'     => $prijsPerStuk,
            'color'     => $kleur,
            'depth'     => $diepte,
            'quantity'  => $aantal
        );
        
        $itemsToSave[] = $newItem;
        
        $totalPrice = $totalPrice + ($prijsPerStuk * $aantal);
    }
}