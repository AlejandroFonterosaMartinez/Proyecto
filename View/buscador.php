<?php
use Config\Conectar;
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
    <link href="../css/buscador.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="../css/index.css" rel="stylesheet" type="text/css">
</head>


<body>
<div class="colorful">
    <?php
    include('header.php');
    // Conectar a la base de datos
    require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');

    // Verificar si hay una consulta enviada
    if (isset($_GET['query'])) {
        // Obtener la consulta y escapar caracteres peligrosos
        $consulta = htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8');

        // Preparar la consulta con parámetros
        $con = Conectar::conexion('busuario');
        $stmt = $con->prepare("SELECT * FROM productos WHERE nombre LIKE :consulta");

        $consulta_param = "%" . $consulta . "%";
        $stmt->bindParam(':consulta', $consulta_param, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) == 0) {
                echo "<body> <div class='errorMsg'>No se han encontrado resultados.</div></body>";
            } else {
                echo "<div class='productos'>";
                foreach ($result as $row) {
                    $cod = $row["Cod_producto"];
                    $precio_formateado = number_format($row["Precio"], 2);
                    echo "<div class='producto'>
        <a href='View/producto.php?codigo=" . $row['Cod_producto'] . "'>
        <img style='width:300px;height:300px;' src='../imagenes/Productos/Categorias/{$row['Categoria']}/$cod.png'></img></a>
          <label>{$row['Nombre']}</label>
          <label>{$precio_formateado}€/Ud.</label>
          <div class='button'>
          <form class='fav' method='post' action='View/favoritos.php'>
          <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
            </form>
            <form class='troll' method='post'>
              <input type = 'submit' class='trollButton' name='anadir' value='Añadir al carrito'><input name ='cod' type='hidden' value = '$cod'></input>
              <input name = 'unidades' type='number' min = '1' max='{$row['Stock']}' value = '1' onkeydown='return false'>
            </form>
          </div>
        </div>";
    }
            }
        } else {
            echo "Error al ejecutar la consulta.";
        }

    }

    ?>
    <script src="../javascript/vision.js"></script> 
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