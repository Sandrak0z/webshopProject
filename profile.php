<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn Profiel</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/base.css">

</head>
<?php include_once("nav.inc.php"); ?>

<body>

<div class="container">
    <h1 class="order-history-title">Mijn Bestelgeschiedenis</h1>
    
    <div class="order-box">
        <div class="order-header">
            <div>
                <strong>Order #1234</strong> | Datum: 7/1
            </div>
            <div class="total-amount">
                Totaal: € 199
            </div>
        </div>

        <div class="order-details">
            <div class="item-row">
                <img src="img/bestekLade_Black.jpg" alt="product">
                <div class="item-info-text">
                    <p><strong>Product Naam</strong></p>
                    <p>Kleur: Zwart | Diepte: 150mm</p>
                </div>
                <div class="item-price">€ 199,00</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>