<?php
require_once('../Model/registro_modelo.php');
if (isset($_POST['submit'])) {
    $nombre = $_POST['username'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $registro = new UserRegistration();
    $registro->register($nombre, $apellidos, $fecha_nacimiento, $email, $password);
}