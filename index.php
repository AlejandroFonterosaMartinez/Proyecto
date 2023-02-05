<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bricomart</title>
</head>

<body>
    <?php
    // Guardar logs de errores para evitar usar echos para ver los errores.
    ini_set("error_log", "logs/error.log");
    // Llamada al controlador del MVC.
    session_start();

    echo "<div style='color:red'>" . $_SESSION['correo'] . "</div>";
    ?>

</body>

</html>