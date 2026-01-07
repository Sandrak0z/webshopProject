<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("toegang geweigerd");
}

if (!empty($_POST['productId'])) {
    try {
        $id = intval($_POST['productId']);
        
        $success = Product::deleteById($id);

        if ($success) {
            header("location: index.php");
            exit();
        } else {
            echo "Er is iets misgegaan in de database.";
        }
    } catch (Exception $e) {
        echo "fout: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit();
}