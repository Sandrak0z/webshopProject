<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");
include_once(__DIR__ . "/classes/Category.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: index.php");
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = Product::getById($id); 
$categories = Category::getAll();

if (!$product) {
    die("product niet gevonden");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel bewerken</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <div class="main">
        <h1>Bewerk artikel: <?= htmlspecialchars($product['ProductName']) ?></h1>
        
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $product['ProductId'] ?>">

            <div class="form-group">
                <label for="name">Productnaam</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['ProductName']) ?>" required>
            </div>

            <div class="form-group">
                <label for="brand">Merk</label>
                <input type="text" id="brand" name="brand" value="<?= htmlspecialchars($product['Brand']) ?>">
            </div>

            <div class="form-group">
                <label for="price">Prijs (€)</label>
                <input type="number" id="price" step="0.01" name="price" value="<?= $product['Price'] ?>" required>
            </div>

            <div class="form-group">
                <label for="stock">Voorraad</label>
                <input type="number" id="stock" name="stock" value="<?= $product['Stock'] ?>" required>
            </div>

            <div class="form-group">
                <label for="categoryId">Categorie</label>
                <select id="categoryId" name="categoryId">
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['CategoryId'] ?>" <?= ($cat['CategoryId'] == $product['CategoryId']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['CategoryName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($product['Description']) ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="primary-btn">wijzigingen opslaan</button>
                <a href="index.php" class="btn-cancel">Annuleren</a>
            </div>
        </form>
    </div>
</body>
</html>