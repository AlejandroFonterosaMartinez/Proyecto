<?php
namespace Controllers;

use Models\Registro_modelo;
use Models\Correo_modelo;

require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'registro_modelo.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'correo_modelo.php');

if (isset($_POST['submit'])) {
    $nombre = $_POST['username'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ENVIO CORREO
    Correo_modelo::enviar_correo($email, $nombre, "Registro BricoTeis", "Gracias " . $nombre . " por registrarte en BricoTeis");
    // REGISTRO
    $registro = new Registro_modelo();
    $registro->register($nombre, $apellidos, $fecha_nacimiento, $email, $password);
    session_start();
    setcookie("Usuario", $email, time() + 60 * 60 * 24 * 30, DIRECTORY_SEPARATOR);
    $_SESSION['correo'] = $email;
    $_SESSION['rol'] = [1];
}