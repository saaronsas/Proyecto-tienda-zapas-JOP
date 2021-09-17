<?php
    session_start();
    include_once('../connection/connection.php');

    if (isset($_SESSION['user_id'])) {
        $_id = $_SESSION['user_id'];

        $query = $conn->query("DELETE FROM shopping_cart WHERE user = $_id");

        echo $conn->error;
    }

    include_once('../connection/close_connection.php');

    echo "<script>window.location.href = '../index.php'</script>";
?>