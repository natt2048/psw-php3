<nav class="menu">
    <?php if (isset($_SESSION['userId'])): ?>
        <a href="index.php">Strona główna</a>
        <span style="color:black">Witaj <?=$_SESSION['username']?>!</span>
        <a href="logout.php">Wyloguj</a>
    <?php else: ?>
        <a href="index.php">Strona główna</a>
        <a href="login.php">Zaloguj</a>
    <?php endif; ?>
</nav>