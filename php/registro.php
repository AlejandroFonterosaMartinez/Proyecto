<?php
include('../Config/Conectar.php');
include('../Model/registro_modelo.php');
include('../Controller/registro_controlador.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>BricoTeis SL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css" />
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
</head>

<body>
    <div class="form">
        <h1>Registro</h1>
        <form name="registro" action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" id="username" name="username" required
                value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" placeholder="Nombre" />
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" required placeholder="Apellidos" />
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required
                value="<?php echo isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : ''; ?>"
                placeholder="Fecha Nacimiento" />
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" required
                value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email" />
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Contraseña" />
            <input type="submit" name="submit" value="Registrarse" />
        </form>
    </div>
</body>

</html>