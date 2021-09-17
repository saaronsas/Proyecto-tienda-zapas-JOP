<?php
    include_once('../connection/connection.php');

    $_id = $_GET['user'];
    $_product = $_GET['product'];

    $query = $conn->query("SELECT * FROM shopping_cart WHERE user = '$_id' AND product = '$_product'");

    if ($query->num_rows == 0) {
        $conn->query("INSERT INTO shopping_cart (user, product, quantity) VALUES ('$_id', '$_product', 1)");
    } else {
        $conn->query("UPDATE shopping_cart SET quantity = quantity + 1 WHERE user = '$_id' AND product = '$_product'");
    }


    echo $conn->error;

    include_once('../connection/close_connection.php');

    echo "<script>window.location.href = '../index.php'</script>";
?>