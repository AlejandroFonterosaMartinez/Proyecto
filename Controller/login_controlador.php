<?php

require_once('../Model/login_modelo.php');

class loginController
{
    public function login($email, $password)
    {
        $user = (new User)->getUser($email, $password);

        if (is_array($user)) {
            $_SESSION['correo'] = $email;
            $_SESSION['rol'] = $user['id_rol'];

            if ($_SESSION['rol'] == 2) {
                header('Location: ../php/admin/admin.php');
                setcookie("Administrador", $email, time() + 60 * 60 * 24 * 30, "/");
                exit;
            } else {
                header('Location: ../index.php');
                setcookie("Usuario", $email, time() + 60 * 60 * 24 * 30, "/");
                exit;
            }
        } else {
            // Si el usuario no existe, establecer el rol en 3
            $_SESSION['rol'] = 3;
            echo '<div class="alerta alert alert-danger" role="alert" style="text-align:center;">Usuario/Contraseña Incorrectos</div>';
        }
    }
}

?>