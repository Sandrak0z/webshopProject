<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>artikel bewerken</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="main">
        <h1>Artikel bewerken</h1>
        
        <form action="processEditProduct.php" method="post" class="admin-form">
            <input type="hidden" name="id" value="1">

            <div class="form-group">
                <label for="name">productnaam</label>
                <input type="text" id="name" name="name" placeholder="Naam van het product" required>
            </div>

            <div class="form-group">
                <label for="brand">Merk</label>
                <input type="text" id="brand" name="brand" placeholder="Merknaam">
            </div>

            <div class="form-group">
                <label for="price">Prijs (€)</label>
                <input type="number" id="price" step="0.01" name="price" placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label for="stock">Voorraad</label>
                <input type="number" id="stock" name="stock" placeholder="Aantal in stock" required>
            </div>

            <div class="form-group">
                <label for="categoryId">Categorie</label>
                <select id="categoryId" name="categoryId">
                    <option value="">Kies een categorie</option>
                    <option value="1">Categorie 1</option>
                    <option value="2">Categorie 2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Afbeelding URL</label>
                <input type="text" id="image" name="image" placeholder="images/product.jpg">
            </div>

            <div class="form-group">
                <label for="colors">kleur opties</label>
                <input type="text" id="colors" name="colors" placeholder="black, white, wood">
            </div>

            <div class="form-group">
                <label for="depths">Diepte opties</label>
                <input type="text" id="depths" name="depths" placeholder="450, 500, 600">
            </div>

            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea id="description" name="description" placeholder="Voer hier de productbeschrijving in..." required></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="primary-btn">wijzigingen opslaan</button>
                <a href="index.php" class="btn-cancel">annuleren</a>
            </div>
        </form>
    </div>
</body>
</html>