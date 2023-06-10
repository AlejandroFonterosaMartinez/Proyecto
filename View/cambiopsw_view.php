<?php

include("sesion.php");
include('..' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'cambiopsw_controlador.php');
use Controlador\CambiarPasswordControlador;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if ($token) {
        if (isset($_POST['nueva_password'])) {
            $nueva_password = $_POST['nueva_password'];
            $confirmar_password = $_POST['confirmar_password'];

            CambiarPasswordControlador::cambiarPassword($token, $nueva_password, $confirmar_password);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css" />
    <title>Cambiar contraseña</title>
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
</head>

<body>

    <div class="form">
        <h1>Cambiar contraseña</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nueva_password">Nueva contraseña:</label>
                <input type="password" name="nueva_password" required>
            </div>
            <div class="form-group">
                <label for="confirmar_password">Confirmar contraseña:</label>
                <input type="password" name="confirmar_password" required>
            </div>
            <input type="submit" value="Cambiar contraseña">
        </form>
    </div>
</body>

</html>