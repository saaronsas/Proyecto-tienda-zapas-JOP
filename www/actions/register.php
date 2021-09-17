<?php
    include_once('../connection/connection.php');

    $_username = $_GET['username'];
    $_password = $_GET['pass'];

    $conn->query("INSERT INTO users (username, pass) VALUES ('$_username', '$_password')");


    echo $conn->error;

    include_once('../connection/close_connection.php');
?>