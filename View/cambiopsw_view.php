<?php
include("sesion.php");
include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
use Config\Conectar;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if ($token) {
        if (isset($_POST['nueva_password'])) {
            $nueva_password = $_POST['nueva_password'];
            $confirmar_password = $_POST['confirmar_password'];

            // Obtener la contraseña actual del usuario
            $con = Conectar::conexion('busuario');
            $sql = "SELECT Contraseña FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":id_usuario", $token);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $contraseña_actual = $row['Contraseña'];

            if ($nueva_password == $confirmar_password) {
                // Verificar si la contraseña actual es diferente de la nueva contraseña
                if (password_verify($nueva_password, $contraseña_actual)) {
                    echo "La nueva contraseña no puede ser la misma que la contraseña actual";
                    exit();
                }

                // Actualizar la contraseña del usuario
                $hashed_password = password_hash($nueva_password, PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET Contraseña = :pass WHERE id_usuario = :id_usuario";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(":pass", $hashed_password);
                $stmt->bindParam(":id_usuario", $token);
                $stmt->execute();

                echo "<script> alert('Contraseña cambiada con éxito')</script>";
                header("Location: login_view.php");
                exit();
            } else {
                // Las contraseñas no coinciden
                echo "Las contraseñas no coinciden";
                exit();
            }
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