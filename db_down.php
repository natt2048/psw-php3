<?php
require_once 'db_connect.php';

$sql = 'DROP DATABASE IF EXISTS my_psw;';
if (mysqli_query($conn, $sql)) {
    echo "Database dropped successfully";
} else {
    echo "Error dropping database: " . mysqli_error($conn);
}

mysqli_close($conn);