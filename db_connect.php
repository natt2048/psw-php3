<?php
$servername = "localhost";
$username = "psw";
$password = "psw123";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
