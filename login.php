<?php
session_start();
include_once(__DIR__. "/classes/User.php");

$error = "";

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = User::login($email, $password);

    if ($user) {
        $_SESSION['user_id']   = $user['customerId']; 
        $_SESSION['user_name'] = $user['firstName'];  
        $_SESSION['role']      = $user['role'];       
        $_SESSION['coins']     = $user['coins'];      
    
        header("Location: index.php");
        exit();
    }

     else {
        $error = "E-mail of wachtwoord is onjuist.";
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

    <h2>Inloggen</h2>

    <form action="" method="post">

        <label for="email">E-mailadres</label>
        <input type="email" id="email" name="email">

        <label for="password">Wachtwoord</label>
        <input type="password" id="password" name="password">

        <?php if(!empty($error)): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

        <input type="submit" value="Log in" class="sign-btn">

    
        <p>Heb je nog geen account? <a href="signup.php">Maak aan</a></p>


    </form>

</div>

</body>
</html>
