<?php
session_start();
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
                        <th style="text-align: right;">Actie</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="product-info">
                            <img src="img/example-product.png" alt="Product">
                            <div>
                                <p class="brand">Blum</p>
                                <p><strong>Legrabox Lade</strong></p>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span class="qty-display">1x</span>
                        </td>
                        <td style="text-align: right;">
                            <a href="#" class="remove-item">Verwijderen</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="details cart-summary">
            <h2>Overzicht</h2>
            <div class="summary-row">
                <span>Subtotaal</span>
                <span>€ 45,00</span>
            </div>
            <div class="summary-row">
                <span>Verzendkosten</span>
                <span style="color: #24a746; font-weight: bold;">Gratis</span>
            </div>
            <hr>
            <div class="summary-row total">
                <span>Totaal</span>
                <span>€ 45,00</span>
            </div>
            
            <button class="primary-btn checkout-btn">Afrekenen</button>
            <p class="coins-notice">Je huidige saldo: <strong>€ <?= number_format($_SESSION['coins'] ?? 0, 2, ',', '.'); ?></strong></p>
        </div>
    </div>
</body>
</html>