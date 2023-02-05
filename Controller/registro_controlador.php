<?php
require_once('../Model/registro_modelo.php');
if (isset($_POST['submit'])) {
    $nombre = $_POST['username'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // ENVIO DEL CORREO:
    $asunto = "Registro en mipagina";
    $msg = "Gracias" . $nombre . " " . $apellidos . " por registrarte en MiPagina disfruta de todos nuestros productos. <BR> En caso de cualquier duda contactanos en mipagina@gmail.com.";
    $header = "From: noreply@mipagina.com" . "\r\n";
    $header .= "Reply-To: noreply@mipagina.com" . "\r\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    $mail = mail($email, $asunto, $msg);
    // REGISTRO
    $registro = new UserRegistration();
    $registro->register($nombre, $apellidos, $fecha_nacimiento, $email, $password);
}