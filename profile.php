<?php
session_start();
include_once(__DIR__ . "/classes/Order.php");

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$orders = Order::getHistory($_SESSION['userId']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn Profiel</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<?php include_once("nav.inc.php"); ?>

<body>

    <div class="profile-container">
        <h1>Mijn Bestelgeschiedenis</h1>

        <?php if (empty($orders)): ?>
            <p>Je hebt nog geen bestellingen geplaatst.</p>
        <?php else: ?>
            <?php foreach ($orders as $o): ?>
                <div class="order-box">
                    <div class="order-header">
                        <strong>Order #<?= htmlspecialchars($o['Id']) ?></strong> | 
                        Datum: <?= htmlspecialchars($o['orderDate']) ?> | 
                        <strong>Totaal: €<?= number_format($o['totalPrice'], 2, ',', '.') ?></strong>
                    </div>

                    <div class="order-details">
                        <?php 
                        $items = Order::getItemsByOrderId($o['Id']); 
                        foreach ($items as $item): 
                        ?>
                            <div class="item-row">
                                <img  src="<?= htmlspecialchars($item['Image']) ?>" alt="Product">
                                <div class="item-info">
                                    <p><strong><?= htmlspecialchars($item['ProductName']) ?></strong></p>
                                    <p class="item-meta">
                                        <?php if (!empty($item['color']) && $item['color'] !== 'Standaard'): ?>
                                            Kleur: <strong><?= htmlspecialchars($item['color']) ?></strong>
                                        <?php endif; ?>

                                        <?php if (!empty($item['depth']) && $item['depth'] !== 'Standaard'): ?>
                                            <?php if (!empty($item['color']) && $item['color'] !== 'Standaard') echo " | "; ?>
                                            Diepte: <strong><?= htmlspecialchars($item['depth']) ?> mm</strong>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="item-price-display">
                                    €<?= number_format($item['Price'], 2, ',', '.') ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>