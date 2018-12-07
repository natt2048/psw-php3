 <?php
require_once 'db_connect.php';

$sql = 'CREATE DATABASE my_psw; USE my_psw; CREATE TABLE users (ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, login varchar(32) NOT NULL, password varchar(64) NOT NULL, name varchar(64), surname varchar(64), email varchar(128));';
if (mysqli_multi_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);