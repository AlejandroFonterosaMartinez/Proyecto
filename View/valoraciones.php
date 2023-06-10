<?php
use Models\Correo_modelo;

include("sesion.php");
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'correo_modelo.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>BricoTeis SL</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/valoraciones.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
</head>


<body>
    <div class="colorful">
        <div id="header">
            <?php include('header.php'); ?>
        </div>
        <div id="scripts">
            <script src="../javascript/vision.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
        </div>
        <div id="formulario">
            <div class="titulo">
                <h1>VALORA NUESTRO SERVICIO</h1>
            </div>
            <form method="post">
                <div id="nombre-field">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br><br>
                </div>

                <div id="valoracion-field">
                    <label for="valoracion">Valoración:</label>
                    <select id="valoracion" name="valoracion" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Excelente">Excelente</option>
                        <option value="Muy Bueno">Muy bueno</option>
                        <option value="Bueno">Bueno</option>
                        <option value="Regular">Regular</option>
                        <option value="Malo">Malo</option>
                    </select><br><br>
                </div>

                <div id="comentario-field">
                    <label for="comentario">Comentario:</label><br>
                    <textarea id="comentario" name="comentario" rows="4" cols="50" required></textarea><br><br>
                </div>

                <div id="submit-field">
                    <input type="submit" name="val" value="Enviar">
                </div>
                <?php if (isset($_POST['val'])) {
                    Correo_modelo::enviar_correo('bricoteis@gmail.com', 'BricoTeis SL', "Valoración de " . $_POST['nombre'] . " recibida", "Valoración: " . $_POST['valoracion'] . "<br>Comentario: " . $_POST['comentario']);
                    echo '<script>
                        Swal.fire({
                            title: "Correo enviado",
                            text: "El correo se ha enviado correctamente.",
                            icon: "success",
                            confirmButtonText: "Aceptar",
                            customClass: {
                                confirmButton: "my-custom-button-class"
                            },
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "my-custom-button-class"
                            }
                        });
                    </script>';
                } ?>
            </form>
        </div>
        <footer>
            <div class="redes">
                <div class="tituloFooter">
                    <h3>Nuestras Redes Sociales</h3>
                </div>
                <div class="contenido">
                    <img src="../imagenes/Footer/RRSS/facebook.svg" />
                    <img src="../imagenes/Footer/RRSS/twitter.svg" />
                    <img src="../imagenes/Footer/RRSS/youtube.svg" />
                    <img src="../imagenes/Footer/RRSS/instagram.svg" />
                    <img src="../imagenes/Footer/RRSS/linkedin.svg" />
                    <img src="../imagenes/Footer/RRSS/pinterest.svg" />
                </div>
            </div>
            <div class="redes">
                <div class="tituloFooter">
                    <h3>Proyecto Ecológico</h3>
                </div>
                <div class="contenido">
                    <a href="../php/eco.php">
                        <img src="../imagenes/Footer/ECO/Agua.svg" />
                        <img src="../imagenes/Footer/ECO/Reciclaje.svg" />
                        <img src="../imagenes/Footer/ECO/Renovable.svg" />
                    </a>
                </div>
            </div>
            <div class="redes">
                <div class="tituloFooter">
                    <h3>Pago 100% Seguro</h3>
                </div>
                <div class="contenido">
                    <img src="../imagenes/Footer/Pago/Amex.svg" />
                    <img src="../imagenes/Footer/Pago/Klarna.svg" />
                    <img src="../imagenes/Footer/Pago/Mastercard.svg" />
                    <img src="../imagenes/Footer/Pago/Paypal.svg" />
                    <img src="../imagenes/Footer/Pago/Visa.svg" />
                </div>
            </div>
            <div class="redes">
                <div class="tituloFooter">
                    <h3>Manténte al día</h3>
                </div>
                <div class="contenido">
                    <a href="aboutUs.php">About Us</a>
                    <a id="newsletter-link">Newsletter </a>
                    <div id="newsletter-overlay">
                        <div id="newsletter-popup">
                            <button id="close-popup">X</button>
                            <h2>Suscríbete a nuestra Newsletter</h2>
                            <p>Ingresa tu correo electrónico para recibir nuestras últimas noticias y ofertas:</p>
                            <form method="post">
                                <input type="email" name="email" placeholder="Tu correo electrónico" required>
                                <button type="submit" name="sub">Suscribirse</button>
                                <?php if (isset($_POST['sub'])) {
                                    Correo_modelo::enviar_correo($_POST['email'], $_SESSION['usuario'], "Gracias por subscribirte a nuestra newsletter" . $_POST['email']);
                                } ?>
                            </form>
                        </div>
                    </div>
                    <a href="valoraciones.php">Valoraciones</a>
                    <script src="../javascript/newsletter.js"></script>
                </div>
            </div>
            <div class="legal">
                <a href="infoLegal.php#privacidad">Política de privacidad</a>
                <a href="infoLegal.php#datos">Recopilación y uso de datos</a>
                <a href="infoLegal.php#cookies">Uso de cookies</a>
                <a href="infoLegal.php#termsConds">Términos y condiciones</a>
            </div>
        </footer>
    </div>
</body>

</html>