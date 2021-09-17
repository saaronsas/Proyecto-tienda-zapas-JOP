<?php
    session_start();
    include_once('../connection/connection.php');

    $_username = $_GET['username'];
    $_password = $_GET['pass'];

    $result = $conn->query("SELECT * FROM users WHERE username = '$_username' AND pass = '$_password'");

    if (!$result) {
        echo "error";
    } else {
        if ($result->num_rows == 1) {
            $_SESSION['user_id'] = $result->fetch_assoc()['id'];
            echo "logged";
        } else {
            echo "notlogged";
        }
    }

    if (isset($_GET['finallogin'])) {
        echo "<script>window.location.href = '../index.php'</script>";
    }

    include_once('../connection/close_connection.php');
?>