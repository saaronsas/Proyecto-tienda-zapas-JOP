<?php
    session_start();
    $_SESSION['user_id'] = null;
    session_destroy();
    echo "<script>window.location.href = '../index.php'</script>";
?>