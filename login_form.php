<div>
    <form action="login.php" method="POST">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" value="<?= isset($_POST['login']) ? $_POST['login'] : ''; ?>">
        <label for="password">Hasło:</label>
        <input type="password" name="password" id="password">
        <button type="submit">Zaloguj</button>
    </form>
</div>