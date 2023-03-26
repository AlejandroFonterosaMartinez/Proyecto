<?php
use Models\Correo_modelo;

include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
use Config\Conectar;

include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'correo_modelo.php');
include("sesion.php");
if (isset($_POST['correopsw'])) {
    $email = filter_var($_POST['correopsw'], FILTER_SANITIZE_EMAIL);
    $con = Conectar::conexion('busuario');

    // Preparar la consulta SQL utilizando marcadores de posición
    $sql = "SELECT id_usuario FROM usuarios WHERE Correo = :email";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Obtener el resultado de la consulta
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró un usuario con el correo electrónico proporcionado
    if ($row) {
        $token = $row['id_usuario'];

        // Verificar que la dirección de correo electrónico sea válida
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $link = "http://localhost/Proyecto/View/cambiopsw_view.php?token=" . $token;
            // Enviar el correo electrónico
            Correo_modelo::enviar_correo($email, "", "Solicitud cambio de contraseña en BricoTeis SL", "Haga clic en el siguiente enlace para cambiar su contraseña: " . $link);
        } else {
            // La dirección de correo electrónico no es válida
            header("Location: login_view.php");
            exit();
        }
    } else {
        // No se encontró un usuario con el correo electrónico proporcionado
        header("Location: login_view.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<link style="text/css" rel="stylesheet" href="../css/cambio.css" />
<html>

<head>
    <meta charset="UTF-8">
    <title>Cambio de contraseña</title>
</head>

<body>
    <h1>Correo enviado a
        <?php echo $_POST['correopsw'] ?>
    </h1>
    <p>Te llevaremos de vuelta en <span id="countdown">10</span> segundos.</p>

    <script>
        var seconds = 10; // segundos totales
        var countdown = setInterval(function () {
            seconds--; // decrementar los segundos
            document.getElementById("countdown").innerHTML = seconds.toString(); // actualizar el elemento HTML con el nuevo valor
            if (seconds <= 0) {
                clearInterval(countdown); // detener la cuenta regresiva
                history.back(); // volver atrás
            }
        }, 1000); // intervalo de tiempo en milisegundos (1000 = 1 segundo)
    </script>

    <div class="loader"></div>

    <script>
        setTimeout(function () {

            history.back();
        }, 10000); // tiempo en milisegundos (10 segundos)
    </script>
</body>
</html>
</head>
<body>