<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");
include_once(__DIR__ . "/classes/Comment.php");
$allComments = Comment::getAllByProductId($productId);

$productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$product = Product::getById($productId);

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
            
        <div class="main-image"
             style="background-image:url('<?= htmlspecialchars($product['Image']) ?>')">
        </div>

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

        <?php if (!empty($product['depths'])): ?>
    <select>
        <?php foreach ($product['depths'] as $depth): ?>
            <option><?= htmlspecialchars(trim($depth)) ?> mm</option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>
        <!--
            <div class="dropdown">
                <label for="depth">Diepte (mm)</label>
                <select id="depth">
                    <option value="">Kies een optie</option>
                    <option value="100">100 mm</option>
                    <option value="150">150 mm</option>
                    <option value="200">200 mm</option>
                </select>
            </div> -->
            <form method="post" action="addToCart.php">
    <input type="hidden" name="productId" value="<?= htmlspecialchars($product['ProductId']) ?>">
    
    <div class="quantity">
    <input type="number" name="quantity" value="1" min="1" max="100" />        
    <input type="submit" value="Toevoegen aan winkelwagen" class="primary-btn" />
    </div>
</form>

            <div class="material-section">
                <h3>Materiaal & kleurkeuze</h3>

                
                <div class="material-row">
                <?php if (!empty($product['colors'])): ?>
    <div class="colors">
        <?php foreach ($product['colors'] as $color): ?>
            <label>
                <input type="radio" name="color">
                <span class="<?= htmlspecialchars(trim($color)) ?>"></span>
            </label>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

                    <div class="material-group">
                        <h4>Houtdecor</h4>
                        <div class="material-options">
                            <input class="lightWood" name="material" title="lightWood" type="radio">
                            <input class="darkWood" name="material" title="darkWood" type="radio">
                            <input class="wood" name="material" title="wood" type="radio">
                        </div>
                    </div>

                    <div class="material-group">
                        <h4>Staal</h4>
                        <div class="material-options">
                            <input class="black" name="material" title="black" type="radio">
                            <input class="gray" name="material" title="gray" type="radio">
                            <input class="white" name="material" title="white" type="radio">
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <div class="commentSection">
    <h3>Laat een reactie achter</h3>
    <div id="comment-list">
    <?php foreach($allComments as $c): ?>
        <div class="comment-item">
            <div class="comment-content">
                <strong><?= htmlspecialchars($c['firstname']); ?>:</strong>
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