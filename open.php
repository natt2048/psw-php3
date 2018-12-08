<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test XSS</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="content">
    <?php require_once 'menu.php' ?>
    <?php
    $Bar = "a";
    $Foo = "Bar";
    $World = "Foo";
    $Hello = "World";
    $a = "Hello";
    ?>
    <div>
        <p>
            $Bar = "a";<br>
            $Foo = "Bar";<br>
            $World = "Foo";<br>
            $Hello = "World";<br>
            $a = "Hello";<br>
        </p>
        <ul>
            <li>$a: <?= $a; ?></li>
            <li>$$a: <?= $$a; ?></li>
            <li>$$$a: <?= $$$a; ?></li>
            <li>$$$$a: <?= $$$$a; ?></li>
            <li>$$$$$a: <?= $$$$$a; ?></li>
            <li>$$$$$$a: <?= $$$$$$a; ?></li>
            <li>$$$$$$$a: <?= $$$$$$$a; ?></li>
        </ul>
    </div>
</div>
</body>
</html>