<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once 'db_connect_psw.php';
        $stmt = $conn->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
        $stmt->bind_param("ss", $_POST['login'], $_POST['password']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = mysqli_fetch_row($result);
            $_SESSION['userId'] = $row[0];
            $_SESSION['username'] = $row[1];
        }
        $stmt->close();
        $conn->close();
    }

if (isset($_SESSION['userId'])) {
    header('Location: index.php');
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formularz</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="content">
    <?php require_once 'menu.php'; ?>
    <?php require_once 'login_form.php'; ?>
</div>
</body>
</html>