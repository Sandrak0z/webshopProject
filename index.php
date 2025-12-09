<?php

include_once(__DIR__ . "/classes/Category.php");
include_once(__DIR__ . "/classes/Product.php");

$categoryId = filter_input(INPUT_GET, 'cat', FILTER_VALIDATE_INT) ?? 0;

$categories = Category::getAll();
$products = Product::getAll($categoryId);

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
  <body>  <?php include_once("nav.inc.php"); ?>



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
        <h1>Welkom bij onze webshop!</h1>
        <p>Bekijk onze producten en ontdek onze duurzame services.</p>
        <div class="products">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <a href="productDetails.php?id=<?= $product['ProductId'] ?>">
                            <img src="<?= htmlspecialchars($product['Image']) ?>" alt="<?= htmlspecialchars($product['ProductName']) ?>" />
                            <h3><?= htmlspecialchars($product['ProductName']) ?></h3>
                            <p>€<?= number_format($product['Price'], 2) ?></p>
                            <h2>Bekijk meer</h2>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Geen producten gevonden voor deze categorie.</p>
            <?php endif; ?>
        </div>
        
    </div>
  </body>
</html>
