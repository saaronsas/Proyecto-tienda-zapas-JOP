<?php
    include_once('connection/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @font-face {
    font-family: "Source Sans Pro";
    font-style: normal;
    font-weight: 200;
    src: url(https://fonts.gstatic.com/s/sourcesanspro/v14/6xKydSBYKcSV-LCoeQqfX1RYOo3i94_wlxdr.ttf)
        format("truetype");
}
@font-face {
    font-family: "Source Sans Pro";
    font-style: normal;
    font-weight: 300;
    src: url(https://fonts.gstatic.com/s/sourcesanspro/v14/6xKydSBYKcSV-LCoeQqfX1RYOo3ik4zwlxdr.ttf)
        format("truetype");
}
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-weight: 300;
}
body {
    font-family: "Source Sans Pro", sans-serif;
    color: white;
    font-weight: 300;
}
body ::-webkit-input-placeholder {
    /* WebKit browsers */
    font-family: "Source Sans Pro", sans-serif;
    color: white;
    font-weight: 300;
}
body :-moz-placeholder {
    /* Mozilla Firefox 4 to 18 */
    font-family: "Source Sans Pro", sans-serif;
    color: white;
    opacity: 1;
    font-weight: 300;
}
body ::-moz-placeholder {
    /* Mozilla Firefox 19+ */
    font-family: "Source Sans Pro", sans-serif;
    color: white;
    opacity: 1;
    font-weight: 300;
}
body :-ms-input-placeholder {
    /* Internet Explorer 10+ */
    font-family: "Source Sans Pro", sans-serif;
    color: white;
    font-weight: 300;
}
.wrapper {
    background: #50a3a2;
    background: linear-gradient(to bottom right, #50a3a2 0%, #53e3a6 100%);
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 400px;
    margin-top: -200px;
    overflow: hidden;
}
.wrapper.form-success .container h1 {
    transform: translateY(85px);
}
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 80px 0;
    height: 400px;
    text-align: center;
}
.container h1 {
    font-size: 40px;
    transition-duration: 1s;
    transition-timing-function: ease-in-put;
    font-weight: 200;
}
form {
    padding: 20px 0;
    position: relative;
    z-index: 2;
}
form input {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    border: 1px solid rgba(255, 255, 255, 0.4);
    background-color: rgba(255, 255, 255, 0.2);
    width: 250px;
    border-radius: 3px;
    padding: 10px 15px;
    margin: 0 auto 10px auto;
    display: block;
    text-align: center;
    font-size: 18px;
    color: white;
    transition-duration: 0.25s;
    font-weight: 300;
}
form input:hover {
    background-color: rgba(255, 255, 255, 0.4);
}
form input:focus {
    background-color: white;
    width: 300px;
    color: #53e3a6;
}
form button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    background-color: white;
    border: 0;
    padding: 10px 15px;
    color: #53e3a6;
    border-radius: 3px;
    width: 250px;
    cursor: pointer;
    font-size: 18px;
    transition-duration: 0.25s;
}
form button:hover {
    background-color: #f5f7f9;
}
@-webkit-keyframes square {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-700px) rotate(600deg);
    }
}
@keyframes square {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-700px) rotate(600deg);
    }
}
        </style>
        <meta charset="UTF-8" />
        <title>Welcome</title>
        <link rel="stylesheet" href="./style.css" />
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <h1>Welcome</h1>

                <form class="form">
                    <input type="text" id="username" placeholder="Username" />
                    <input type="password" id="password" placeholder="Password" />
                    <button onclick="login()" id="login-button">Login</button> <button onclick="register()" id="login-button">Register</button>
                </form>
            </div>

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </body>
    <script>
$("#login-button").click(function(event){
         event.preventDefault();
     
     $('form').fadeOut(500);
     $('.wrapper').addClass('form-success');
});

function register() {
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
        }
        };

        xmlhttp.open("GET","actions/register.php?username=" + username + "&pass=" + password);
        xmlhttp.send();

    }

    function login() {
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == " notlogged") {
                alert("No se ha encontrado un usuario con esa contraseña");
            } else if (this.responseText == " error") {
                alert("Ha ocurrido un error");
            } else if (this.responseText == " logged") {
                window.location.href = "actions/login.php?username=" + username + "&pass=" + password + "&finallogin=true";
            }
        }
        };

        xmlhttp.open("GET","actions/login.php?username=" + username + "&pass=" + password);
        xmlhttp.send();

    }

</script>
</html>
<?php
    include_once('connection/close_connection.php');
?>