<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once(__DIR__ . "/classes/Product.php");
include_once(__DIR__ . "/classes/Comment.php");

$productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = Product::getById($productId);
$allComments = Comment::getAllByProductId($productId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php include_once("nav.inc.php"); ?>

    <div class="container">
        <div class="image-section">
            <div class="main-image" style="background-image:url('<?= htmlspecialchars($product['Image']) ?>')"></div>
            <div class="images-row">
                <div class="images"></div>
                <div class="images"></div>
                <div class="images"></div>
            </div>
        </div>

        <div class="details">
            <div class="brand"><?= htmlspecialchars($product['Brand']) ?></div>
            <h1><?= htmlspecialchars($product['ProductName']) ?></h1>

            <div class="price">
                €<?= number_format($product['Price'], 2, ',', '.') ?>
                <?php if ($product['Stock'] > 0): ?>
                    <span class="in-stock">• Op voorraad</span>
                <?php else: ?>
                    <span class="out-stock">• Niet op voorraad</span>
                <?php endif; ?>
            </div>
            <div class="product-description">
                <h3>Beschrijving</h3>
                <p><?= htmlspecialchars($product['Description']) ?></p>
            </div>

            <form method="post" action="addToCart.php">
                <input type="hidden" name="productId" value="<?= htmlspecialchars($product['ProductId']) ?>">

                <?php if (!empty($product['depths'])): ?>
                    <div class="dropdown">
                        <label for="depth">Diepte (mm)</label>
                        <select name="depth" id="depth">
                            <?php foreach ($product['depths'] as $depth): ?>
                                <option value="<?= htmlspecialchars(trim($depth)) ?>"><?= htmlspecialchars(trim($depth)) ?> mm</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="material-section">
                    <h3>Kies je kleur</h3>
                    <div class="color-selector">
                        <?php if (!empty($product['colors'])): ?>
                            <?php foreach ($product['colors'] as $index => $color): 
                                $cleanColor = htmlspecialchars(trim($color)); ?>
                                <label class="color-option">
                                    <input type="radio" name="color" value="<?= $cleanColor ?>" <?= $index === 0 ? 'checked' : '' ?>>
                                    <span class="swatch <?= $cleanColor ?>"></span>
                                    <span class="color-name"><?= ucfirst($cleanColor) ?></span>
                                </label>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Geen kleurkeuze beschikbaar.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="quantity">
                    <input type="number" name="quantity" value="1" min="1" max="100" />        
                    <input type="submit" value="Toevoegen aan winkelwagen" class="primary-btn" />
                </div>
            </form> 
            </div> 
    </div> 

    <div class="commentSection">
        <h3>Laat een reactie achter</h3>
        <div id="comment-list">
            <?php foreach($allComments as $c): ?>
                <div class="comment-item">
                    <div class="comment-content">
                        <strong><?= htmlspecialchars($c['firstName']); ?>:</strong>
                        <p><?= htmlspecialchars($c['text']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="commentForm">
            <textarea id="commentText" placeholder="Wat vind je van dit product?"></textarea>
            <button id="btnAddComment" class="primary-btn" data-post-id="<?= $product['ProductId']; ?>" >Verstuur</button>
        </div>
    </div>

    <script src="comments.js"></script>
</body>
</html>