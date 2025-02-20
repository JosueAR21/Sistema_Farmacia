<?php
session_start();

if (isset($_SESSION['usuario'])) {
    session_unset();
    session_destroy();
}

header('Location: http://localhost/Ekuifarm-Frontend/login.php');
exit();
?>
