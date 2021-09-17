<?php
    session_start();
    include_once('connection/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Carrito de la compra</title>
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
            integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
            crossorigin="anonymous"
        />
        <script
            src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
            integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
            integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"
        ></script>
        <style>
            body {
                padding-top: 80px;
                background: #50a3a2;
                background: linear-gradient(
                    to bottom right,
                    #50a3a2 0%,
                    #53e3a6 100%
                );
            }
            .show-cart li {
                display: flex;
            }
            .container {
                width: 80%;
            }
            .card {
                margin-bottom: 20px;
            }
            .card-img-top {
                width: 200px;
                height: 200px;
                align-self: center;
            }
            .elecc {
                width: 130px;
            }
            .clear-cart {
                position: absolute;
                left: 160px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse bg-inverse fixed-top bg-faded">
            <div class="row">
                <div class="col">
                    <button
                        type="button"
                        class="btn btn-success elecc"
                        data-toggle="modal"
                        data-target="#cart"
                    >
                        Carrito (<span class="total-count"></span>)</button
                    ><button class="clear-cart btn btn-danger elecc" onclick="borrar()">
                        Vaciar carrito
                    </button>
                    <?php
                        if (isset($_SESSION['user_id'])) {
                            echo '<button onclick="logout()" class="btn btn-danger offset-xl-10">
                            Logout
                        </button>';
                        } else {
                            echo '<button onclick="login()" class="btn btn-secondary offset-xl-10">
                            Login
                        </button>';
                        }
                    ?>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">

                <?php
                    $query = $conn->query("SELECT * FROM products");
                    while ($row = $query->fetch_assoc()) {
                        echo '
                        <div class="col">
                            <div class="card" style="width: 20rem">
                                <img
                                    class="card-img-top"
                                    src="'.$row['url'].'"
                                    alt="'.$row['label'].'"
                                />
                                <div class="card-block">
                                    <h4 class="card-title">'.$row['label'].'</h4>
                                    <p class="card-text">Precio: $ '.$row['price'].'</p>
                                    <a
                                        href="#"
                                        data-name="'.$row['label'].'"
                                        onclick="comprar('.$row['id'].')"
                                        class="add-to-cart btn btn-primary"
                                        >Añadir al carrito</a
                                    >
                                </div>
                            </div>
                        </div>
                        ';

                    }
                ?>

                
        </div>

        <div
            class="modal fade"
            id="cart"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Carrito
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="show-cart table">
                            <?php
                                if (isset($_SESSION['user_id'])) {
                                    
                                    $query = $conn->query("SELECT p.label, c.quantity FROM products AS p, shopping_cart AS c WHERE p.id = c.product AND c.user = $_SESSION[user_id]");
                                    while ($row = $query->fetch_assoc()) {
                                        echo "<tr><td>$row[label]</td><td>$row[quantity]</td><td></td></tr>";
                                    }

                                }
                            ?>
                        </table>
                        <div>
                            Precio total: $<span class="total-cart"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-outline-danger"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                        <button type="button" class="btn btn-outline-success">
                            Comprar ya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        let userid = <?php if (isset($_SESSION['user_id'])) { echo $_SESSION['user_id']; } else {echo "null";} ?>;

        function comprar(id) {
            window.location.href = "actions/add_shopping.php?user=" + userid + "&product=" + id;
        }

        function borrar() {
            window.location.href = "actions/clear_cart.php";
        }

        function login() {
            window.location.href = "login.php";
        }

        function logout() {
            window.location.href = "actions/logout.php";
        }

    </script>
</html>
<?php
    include_once('connection/close_connection.php');
?>