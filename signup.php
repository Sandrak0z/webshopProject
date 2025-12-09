<?php
include_once(__DIR__. "/classes/User.php");

$error = "";

if(!empty($_POST)) {  

    try {
    $user = new User();
    $user->setFirstname ($_POST['firstname']);
    $user->setLastname ($_POST["lastname"]);
    $user->setEmail ($_POST["email"]);
    $user->setPassword ($_POST["password"]);
    $user->setConfirmpassword($_POST["confirmpassword"]); 


    $user->save();
    }
    catch (\throwable $th) {
    $error = $th->getMessage();
}}



?>
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
    <?php if(!empty($error)) : ?>
        <div class="message error"><?= $error ?></div>
<?php endif; ?>


    <form action="" method="post">

        <label for="firstname">Voornaam </label>
        <input type="text" id="firstname" name="firstname">

        <label for="lastname">Achternaam </label>
        <input type="text" id="lastname" name="lastname">

        <label for="email">E-mailadres</label>
        <input type="email" id="email" name="email">

        <label for="password">Wachtwoord</label>
        <input type="password" id="password" name="password">

        <label for="confirmpassword">Bevestig wachtwoord</label>
        <input type="password" id="confirmpassword" name="confirmpassword">

        <input type="submit" value="Account aanmaken" class="sign-btn">	

        <p>Heb je al een account? <a href="login.php">Log in</a></p>

    </form>

</div>

</body>
</html>
