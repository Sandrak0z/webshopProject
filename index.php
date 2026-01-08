<?php
session_start(); 
$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
include_once(__DIR__ . "/classes/Category.php");
include_once(__DIR__ . "/classes/Product.php");

if (isset($_GET['cat'])) {
    $categoryId = (int)$_GET['cat'];
} else {
    $categoryId = 0;
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = "";
}

$categories = Category::getAll();
$products = Product::getAll($categoryId, $search);

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VanHoecke</title>
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>

<?php include_once("nav.inc.php"); ?>

<body>
    <div class="main">
        <div class="categorie">
            <h3>CATEGORIEËN</h3>
            <ul>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <a href="index.php?cat=<?= $cat['CategoryId'] ?>">
                            <?= htmlspecialchars($cat['CategoryName']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="content">
            <div class="searchContainer">
                <form action="index.php" method="get">
                    <input type="text" name="search" placeholder="Zoek een artikel..." value="<?= htmlspecialchars($search) ?>">
                    <button type="submit" class="search">Zoeken</button>
                    
                    <?php if($categoryId > 0): ?>
                        <input type="hidden" name="cat" value="<?= $categoryId ?>">
                    <?php endif; ?>
                </form>
            </div>

            <?php if ($isAdmin): ?>
                <div class="admin-controls">
                    <h2>Admin Paneel</h2>
                    <p>Welkom Admin! Je kunt hier de shop beheren.</p>
                    <a href="addProduct.php" class="primary-btn">+ Product Toevoegen</a>
                </div>
            <?php endif; ?>

            <h1>Welkom bij onze webshop!</h1>
            <p>Bekijk onze producten en ontdek onze duurzame services.</p>

            <div class="products">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <a href="productDetails.php?id=<?= $product['ProductId'] ?>">
                                <img src="<?= htmlspecialchars($product['Image']) ?>" alt="<?= htmlspecialchars($product['ProductName']) ?>" />
                                <h3><?= htmlspecialchars($product['ProductName']) ?></h3>
                                <p>€<?= number_format($product['Price'], 2, ',', '.') ?></p>
                                <h2>Bekijk meer</h2>
                            </a>
                            
                            <?php if ($isAdmin): ?>
                                <div class="product-admin-actions">
                                    <a href="editProduct.php?id=<?= $product['ProductId'] ?>" class="btn-edit">Bewerken</a>
                                    
                                    <form action="deleteProduct.php" method="post" onsubmit="return confirm('Product echt verwijderen?');" style="display:inline;">
                                        <input type="hidden" name="productId" value="<?= $product['ProductId']; ?>">
                                        <button type="submit" class="btn-delete">Verwijderen</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Geen producten gevonden voor deze categorie.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>