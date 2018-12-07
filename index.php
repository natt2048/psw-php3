<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once 'data_form.php';
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(!isset($_SESSION['userId'])) { //rejestracja
            if (strlen($_POST['login']) <= 5) {
                die('Login musi być dłuższy niż 5 znaków!');
            }
            if (strlen($_POST['password']) <= 5) {
                die('Haslo musi być dłuższe niż 5 znaków!');
            }
            if (strlen($_POST['name']) > 0 && strlen($_POST['name']) <= 3) {
                die('Imię musi być dłuższe niż 3 znaki!');
            }
            if (strlen($_POST['surname']) > 0 && strlen($_POST['surname']) <= 5) {
                die('Nazwisko musi być dłuższe niż 5 znaków!');
            }
            if (strlen($_POST['email']) > 0 && strlen($_POST['email']) <= 5) {
                die('Email musi być dłuższy niż 5 znaków!');
            }
            require_once 'db_connect_psw.php';
            $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
            $stmt->bind_param("s", $_POST['login']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                die('Ten login jest już zajęty...');
            }
            $stmt = $conn->prepare("INSERT INTO users (login, password, name, surname, email) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $_POST['login'], $_POST['password'], $_POST['name'], $_POST['surname'], $_POST['email']);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            
        } else { //update danych
            if (strlen($_POST['login']) > 0 && strlen($_POST['login']) < 5) {
                die('Login musi być dłuższy niż 5 znaków!');
            }
            //nie sprawdza, czy login jest zajęty - można się podszyć pod innego użytkownika!
            if (strlen($_POST['password']) > 0 && strlen($_POST['password']) <= 5) {
                die('Haslo musi być dłuższe niż 5 znaków!');
            }
            if (strlen($_POST['name']) > 0 && strlen($_POST['name']) <= 3) {
                die('Imię musi być dłuższe niż 3 znaki!');
            }
            if (strlen($_POST['surname']) > 0 && strlen($_POST['surname']) <= 5) {
                die('Nazwisko musi być dłuższe niż 5 znaków!');
            }
            if (strlen($_POST['email']) > 0 && strlen($_POST['email']) <= 5) {
                die('Email musi być dłuższy niż 5 znaków!');
            }
            require_once 'db_connect_psw.php';
            $stmt = $conn->prepare("UPDATE users SET login = ?, password = ?, name = ?, surname = ?, email = ? WHERE ID = ?");
            $stmt->bind_param("sssssi", $_POST['login'], $_POST['password'], $_POST['name'], $_POST['surname'], $_POST['email'], $_SESSION['userId']);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conn->close();
        }
        require_once 'submitted.php';
    }