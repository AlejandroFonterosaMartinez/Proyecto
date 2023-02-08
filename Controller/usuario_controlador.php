<?php
require_once('../Model/usuario_modelo.php');


if (isset($_POST['submit'])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['password'];
    if (empty($correo) || empty($contraseña)) {
        echo '<div class="alert alert-danger">Correo/Contraseña vacios </div>';
    } else {
        $user = new User;
        if ($user->getUser($correo, $contraseña)) {
            session_start();
            $_SESSION['correo'] = $correo;
 
            header("Location: ../index.php");
        } else{
            echo '<div class="alert alert-danger">Correo/Contraseña inválido</div>';
        }
    }
}
?>