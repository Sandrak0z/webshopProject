<nav class="navbar">
      <div class="logo"><a href="index.php"><img src="img/logoVnhoecke.png" alt="logo" /></a></div>
      <div class="center-nav">
        <a href="index.php">Shop</a>
        <a href="https://www.vanhoecke.be/nl/producten">Producten</a>
        <a href="https://www.vanhoecke.be/nl/services">Services</a>
      </div>
      <div class="right-nav">
      <?php if (isset($_SESSION['userId'])): ?>
        <div class="user-info">
            <span class="userName">Welkom, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong></span>
            <span cclass="userCoins">€ <?php echo $_SESSION['coins']; ?></span>
        </div>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a  class="admin-link">Admin</a>
        <?php endif; ?>

        <a href="logout.php" class="primarybtn">Uitloggen</a>
    <?php else: ?>
        <a href="login.php" class="primarybtn">
            <img src="img/pct_aanmelden.png" alt="Aanmelden">
        </a>
    <?php endif; ?>

    <a href="profile.php" class="profile-link">Profiel</a>

    <a href="cart.php" class="primarybtn">
      <img id="shoppingcart" src="img/pct_winkelmandje.png" alt="Winkelmandje">
    </a>
  </div>
    </nav>