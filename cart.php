<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$realIds = [];
foreach ($cart as $item) {
    if (isset($item['productId'])) {
        $realIds[] = (int)$item['productId'];
    }
}
$realIds = array_unique($realIds);

$dbProducts = !empty($realIds) ? Product::getCartDetails($realIds) : [];

$totalPrice = 0;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen - Van Hoecke</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="container cart-page">
        <div class="details cart-items">
            <h2>Je winkelwagen</h2>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th >Aantal</th>
                        <th >Prijs</th>
                        <th >Actie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cart)): ?>
                        <?php foreach ($cart as $key => $details): 
                            $pInfo = null;
                            foreach ($dbProducts as $p) {
                                if ($p['ProductId'] == $details['productId']) {
                                    $pInfo = $p;
                                    break;
                                }
                            }

                            if ($pInfo):
                                $subtotal = $pInfo['Price'] * $details['quantity'];
                                $totalPrice += $subtotal; 
                        ?>
                        <tr>
                            <td class="product-info">
                                <img src="<?= htmlspecialchars($pInfo['Image']) ?>" alt="Product">
                                <div>
                                    <p class="brand"><?= htmlspecialchars($pInfo['Brand']) ?></p>
                                    <p><strong><?= htmlspecialchars($pInfo['ProductName']) ?></strong></p>
                                    <p>
                                        Kleur: <?= htmlspecialchars($details['color']) ?> | 
                                        Diepte: <?= htmlspecialchars($details['depth']) ?> mm
                                    </p>
                                </div>
                            </td>
                            <td >
                                <span class="qty-display"><?= $details['quantity'] ?>x</span>
                            </td>
                            <td >
                                € <?= number_format($subtotal, 2, ',', '.') ?>
                            </td>
                            <td id="removeFromCart">
                                <a href="removeFromCart.php?key=<?= urlencode($key) ?>" class="remove-item">✕</a>
                            </td>
                        </tr>
                        <?php endif; endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Je winkelwagen is leeg.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="details cart-summary">
            <h2>Overzicht</h2>
            <div class="summary-row">
                <span>Subtotaal</span>
                <span>€ <?= number_format($totalPrice, 2, ',', '.') ?></span>
            </div>
            <div class="summary-row">
                <span>Verzendkosten</span>
                <span id="gratis">Gratis</span>
            </div>
            <hr>
            <div class="summary-row total">
                <span>Totaal</span>
                <span>€ <?= number_format($totalPrice, 2, ',', '.') ?></span>
            </div>
            
            <form action="placeOrder.php" method="POST">
                <button type="submit" class="primary-btn checkout-btn">Afrekenen</button>
            </form>
            <p class="coins-notice">Je huidige saldo: <strong>€ <?= number_format($_SESSION['coins'] ?? 0, 2, ',', '.'); ?></strong></p>
        </div>
    </div>
</body>
</html>