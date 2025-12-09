<?php
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
            <div class="main-image"></div>

            <div class="images-row">
                <div class="images"></div>
                <div class="images"></div>
                <div class="images"></div>
            </div>
        </div>

        <div class="details">
            <div class="brand">vanhoecke</div>
            <h1>Wood Oak (Bestek)</h1>

            <div class="price">€167,00 – €221,00 <span class="in-stock">• Op voorraad</span></div>

            <div class="dropdown">
                <label for="depth">Diepte (mm)</label>
                <select id="depth">
                    <option value="">Kies een optie</option>
                    <option value="100">100 mm</option>
                    <option value="150">150 mm</option>
                    <option value="200">200 mm</option>
                </select>
            </div>

            <div class="quantity">
                <input type="number" value="1" min="1" />
                <input type="submit" value="Toevoegen aan winkelwagen" class="primary-btn" />
            </div>

            <div class="material-section">
                <h3>Materiaal & kleurkeuze</h3>

                <div class="material-row">

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

</body>
</html>
