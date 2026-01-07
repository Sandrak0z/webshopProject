<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("toegang geweigerd");
}

if (!empty($_POST)) {
    try {
        $p = new Product();
        
        $p->setProductName($_POST['name']);
        $p->setBrand($_POST['brand']);
        $p->setPrice($_POST['price']);
        $p->setCategoryId($_POST['categoryId']);
        $p->setStock($_POST['stock']);
        $p->setImage($_POST['image']);
        $p->setColorOptions($_POST['colors']);
        $p->setDepthOptions($_POST['depths']);
        $p->setDescription($_POST['description']);

        $success = $p->save();

        if ($success) {
            header("Location: index.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo "fout bij toevoegen " . $error;
    }
}