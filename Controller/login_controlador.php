<?php
namespace Controllers;

use Models\Login_modelo;

require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'login_modelo.php');


class Login_controlador
{
    /**
     * Inicia sesión de usuario en el sistema.
     *
     * @param string $email Dirección de correo electrónico del usuario.
     * @param string $password Contraseña del usuario.
     *
     * @return void
     */
    public function login($email, $password)
    {

        $user = (new Login_modelo)->loguearUsuario($email, $password);
        if (is_array($user)) {
            $_SESSION['correo'] = $email;
            $_SESSION['rol'] = $user['id_rol'];
            $_SESSION['usuario'] = $user['id_usuario'];
            if ($_SESSION['rol'] == 2) {
                setcookie("Administrador", $email, time() + 60 * 60 * 24 * 30, "/");
                setcookie("Sesion-Token", mt_rand(154344553, 134534534550), time() + 60 * 60 * 24 * 30, "/");
                setcookie("Sesion-Id", mt_rand(100000000, 5000000000), time() + 60 * 60 * 24 * 30, "/");
                setcookie("Coin", "€", time() + 60 * 60 * 24 * 30, "/");
                header('Location: ../php/admin/admin.php');
            } else {
                setcookie("Usuario", $email, time() + 60 * 60 * 24 * 30, "/");
                setcookie("Sesion-Token", mt_rand(154344553, 134534534550), time() + 60 * 60 * 24 * 30, "/");
                setcookie("Sesion-Id", mt_rand(100000000, 5000000000), time() + 60 * 60 * 24 * 30, "/");
                setcookie("Coin", "€", time() + 60 * 60 * 24 * 30, "/");
                header('Location: ../index.php');
            }
        } else {
            // Si el usuario no existe, establecer el rol en 3
            $_SESSION['rol'] = 3;
            echo '<div class="alerta alert alert-danger" role="alert" style="text-align:center;">Usuario/Contraseña Incorrectos</div>';
        }
    }
}

?>