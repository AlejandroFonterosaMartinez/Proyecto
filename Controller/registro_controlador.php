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

    // VERIFICAR SI EL CORREO YA ESTÁ REGISTRADO
    $usuario = new Registro_modelo();
    $usuario_encontrado = $usuario->getIdUsuario($email);
    if ($usuario_encontrado) {
        // EL CORREO YA ESTÁ REGISTRADO, NO SE ENVÍA EL CORREO DE REGISTRO Y SE MUESTRA UN MENSAJE DE ERROR
        echo '<div class="alert alert-danger" role="alert">El correo ya está en uso, por favor utilice otro correo para registrarse.</div>';
        exit;
    } else {
        // EL CORREO NO ESTÁ REGISTRADO, SE ENVÍA EL CORREO DE REGISTRO Y SE REGISTRA EL USUARIO
        // ENVIO CORREO
        Correo_modelo::enviar_correo($email, $nombre, "Registro BricoTeis", "Gracias " . $nombre . " por registrarte en BricoTeis");
        // REGISTRO
        $registro = new Registro_modelo();
        $registro->register($nombre, $apellidos, $fecha_nacimiento, $email, $password);
        session_start();
        setcookie("Usuario", $email, time() + 60 * 60 * 24 * 30, DIRECTORY_SEPARATOR);
        setcookie("Sesion-Token", mt_rand(154344553, 134534534550), time() + 60 * 60 * 24 * 30, "/");
        setcookie("Sesion-Id", mt_rand(100000000, 5000000000), time() + 60 * 60 * 24 * 30, "/");
        setcookie("Coin", "€", time() + 60 * 60 * 24 * 30, "/");
        $_SESSION['correo'] = $email;
        $_SESSION['rol'] = [1];
        $_SESSION['usuario'] = $usuario;
    }
}