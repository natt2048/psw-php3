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
    <div>
        <?php if (isset($_SESSION['userId'])) : ?>
            <p>Twoje dane zostały zaktualizowane!</p>
        <?php else: ?>
            <p>Rejestracja przebiegła pomyślnie! Teraz możesz się zalogować.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>