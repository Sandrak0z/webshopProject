<?php
session_start();
include_once(__DIR__ . "/classes/Category.php");
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
$error = "";

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

        if ($p->save()) {
            header("location: index.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }
}


$categories = Category::getAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Product toevoegen admin</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="container" id="adminContainer">
        <h1>Nieuw Product Toevoegen</h1>
        
        <form method="POST" class="admin-form">
        <?php if(!empty($error)): ?>
        <div class="alert" >
            <strong>Oeps!</strong> <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
            
            <div class="form-group">
                <label for="name">Productnaam</label>
                <input type="text" id="name" name="name" required placeholder="Bv keukentafel">
            </div>
            <div class="form-group">
                <label for="description">Productomschrijving</label>
                <textarea id="description" name="description" required placeholder="Vertel iets over het product..."></textarea>
            </div>
            <div class="form-group">
                <label for="brand">Merk</label>
                <input type="text" id="brand" name="brand" required placeholder="Bv VanHoecke ">
            </div>

            <div class="form-group">
                <label for="category">Categorie</label>
                <select id="category" name="categoryId">
                    <?php foreach($categories as $c): ?>
                        <option value="<?= $c['CategoryId'] ?>"><?= htmlspecialchars($c['CategoryName']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Prijs (€)</label>
                <input type="number" step="0.01" id="price" name="price" required min="0">
            </div>

            <div class="form-group">
                <label for="stock">Voorraad</label>
                <input type="number" id="stock" name="stock" value="10" required min="0">
            </div>

            <div class="form-group">
                <label for="image">Afbeelding URL</label>
                <input type="text" id="image" name="image" placeholder="img/productImage1.jpg ">
            </div>

            <div class="form-group">
                <label for="colors">Beschikbare Kleuren (scheid met komma)</label>
                <input type="text" id="colors" name="colors" placeholder="black, white, lightWood">
                <small>Kies uit volgende kleuren: black, white, gray, lightWood, wood, darkWood  .</small>
            </div>

            <div class="form-group">
                <label for="depths">Beschikbare Dieptes (scheid met komma)</label>
                <input type="text" id="depths" name="depths" placeholder="450, 500, 550">
            </div>

            <button type="submit" class="primary-btn" id="adminBtn">Product Opslaan</button>
        </form>
    </div>
</body>
</html>