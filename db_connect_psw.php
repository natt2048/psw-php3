<?php
$servername = "localhost";
$username = "psw";
$password = "psw123";
$dbname = "my_psw";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
