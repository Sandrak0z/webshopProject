<?php
session_start();
include_once(__DIR__ . "/classes/Product.php");

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = [];
}
$cartIds = array_keys($cart);

$cartItems = Product::getCartDetails($cartIds);

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
                        <th style="text-align: center;">Aantal</th>
                        <th style="text-align: right;">Prijs</th>
                        <th style="text-align: right;">Actie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $item): 
                            $qty = $cart[$item['ProductId']]; 
                            $subtotal = $item['Price'] * $qty;
                            $totalPrice += $subtotal; 
                        ?>
                        <tr>
                            <td class="product-info">
                                <img src="<?= htmlspecialchars($item['Image']) ?>" alt="Product">
                                <div>
                                    <p class="brand"><?= htmlspecialchars($item['Brand']) ?></p>
                                    <p><strong><?= htmlspecialchars($item['ProductName']) ?></strong></p>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="qty-display"><?= $qty ?>x</span>
                            </td>
                            <td style="text-align: right;">
                                € <?= number_format($subtotal, 2, ',', '.') ?>
                            </td>
                            <td style="text-align: right;">
                                <a href="removeFromCart.php?id=<?= $item['ProductId'] ?>" class="remove-item">✕</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td>
                                Je winkelwagen is leeg.
                            </td>
                        </tr>
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
                <span style="color: #24a746; font-weight: bold;">Gratis</span>
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