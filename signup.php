<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/auth.css">

</head>
<?php include_once("nav.inc.php"); ?>

<body>


<div class="form-container">

    <h2>Maak een account aan</h2>

    <form action="" method="post">

        <label for="firstname">Voornaam </label>
        <input type="text" id="firstname">

        <label for="lastname">Achternaam </label>
        <input type="text" id="lastname">

        <label for="email">E-mailadres</label>
        <input type="email" id="email">

        <label for="password">Wachtwoord</label>
        <input type="password" id="password">

        <label for="confirmpassword">Bevestig wachtwoord</label>
        <input type="password" id="confirmpassword">

        <input type="submit" value="Account aanmaken" class="sign-btn">	

        <p>Heb je al een account? <a href="login.php">Log in</a></p>

    </form>

</div>

</body>
</html>
