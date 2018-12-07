<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test XSS</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="content">
    <?php require_once 'menu.php'?>
    <p>Witaj na naszej stronie! Zarejestruj się i podaj nam swoje dane osobowe!</p>
    <div>
        <?php
            $row = null;
            if (isset($_SESSION['userId'])) {
                require_once 'db_connect_psw.php';
                $stmt = $conn->prepare("SELECT * FROM users WHERE ID = ?");
                $stmt->bind_param("i", $_SESSION['userId']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = mysqli_fetch_row($result);
                $row[0];
                $stmt->close();
                $conn->close();
            }
        ?>
        <form action="" method="POST">
            <div>
                <label for="login">Login</label>
                <input id="login" type="text" pattern="^[A-Za-z]+$" name="login" value=<?= $row !== null ? $row[1] : ''?>>
            </div>
            <div>
                <label for="password">Hasło</label>
                <input id="password" type="password" name="password" value=<?= $row !== null ? $row[2] : ''?>>
            </div>
            <div>
                <label for="name">Imię</label>
                <input id="name" type="text" pattern="^[A-Z][a-z]+$" name="name" value=<?= $row !== null ? $row[3] : ''?>>
            </div>
            <div>
                <label for="surname">Nazwisko</label>
                <input id="surname" type="text" pattern="^[A-Z][a-z]+$" name="surname" value=<?= $row !== null ? $row[4] : ''?>>
            </div>
            <div>
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" value=<?= $row !== null ? $row[5] : ''?>>
            </div>
            <button type="reset">Wyczyść</button>
            <button type="submit">Wyślij</button>
        </form>
    </div>
    <p>Przykładowa quotemeta: <?= quotemeta('We will send you lots of spam. (You sure you want that?!)');?></p>
</div>
</body>
</html>