<?php
include('../Config/Conectar.php');
include('../Model/usuario_modelo.php');
include('../Controller/usuario_controlador.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    (new loginController)->login($_POST['correo'], $_POST['password']);
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
    <title>BricoTeis SL</title>
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
</head>

<body>

    <div class="container">
        <div class="row mt-3 justify-content-md-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input class="form-control" type="email" name="correo"
                            value="<?php echo isset($_GET['correo']) ? $_GET['correo'] : '' ?>" placeholder="Correo"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input class="form-control" type="password" name="password" placeholder="Contraseña" required />
                    </div>
                    <button type="submit" name="submit" class="btn btn-sm btn-block btn-primary">Iniciar Sesion</button>
                </form>
                <p>Todavía sin una cuenta? <a href='registro.php'>Registrate aquí</a></p>
            </div>
        </div>
    </div>

</body>

</html>