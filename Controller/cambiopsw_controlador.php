<?php

namespace Controlador;

use Models\CambiarPasswordModelo;

include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'cambiopsw_modelo.php');
class CambiarPasswordControlador
{

    public static function cambiarPassword($token, $nueva_password, $confirmar_password)
    {

        $mensaje = CambiarPasswordModelo::cambiarPassword($token, $nueva_password, $confirmar_password);

        if ($mensaje === "Contraseña cambiada con éxito") {
            echo "<script> alert('Contraseña cambiada con éxito')</script>";
            header("Location: login_view.php");
            exit();
        } else {
            echo $mensaje;
            exit();
        }
    }

}