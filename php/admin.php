<?php

session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header('Location: ../index.php');
    exit;
}
$logins = [];
echo 'HOLA ADMINISTRADOR:  ' . $_SESSION['correo'] . " se ha conectado a las: " . date("Y-m-d H:i:s");


?>