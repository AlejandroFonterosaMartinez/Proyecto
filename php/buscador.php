<?php
use Config\Conectar;

include('sesion.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>


<body>
    <?php
    include('header.php');
    // Conectar a la base de datos
    require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');

    // Verificar si hay una consulta enviada
    if (isset($_GET['query'])) {
        // Obtener la consulta y escapar caracteres peligrosos
        $consulta = htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8');

        // Preparar la consulta con parámetros
        $stmt = Conectar::conexion()->prepare("SELECT * FROM productos WHERE nombre LIKE :consulta");

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
                    echo " <a href='producto.php?codigo=" . $cod . "'><div class='producto'>";
                    echo "<img src='../imagenes/Productos/" . $row["Cod_producto"] . ".png'></a>";
                    echo "<label>" . $row['Nombre'] . "</label>";
                    echo "<label>" . $precio_formateado . "€/Ud</label>";
                    echo "<div class='button'>";
                    echo "  <form class='fav' method='post' action='favoritos.php'>
                    <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
                      <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
                      </form>
                      <form class='troll' method='post'>
                        <input type='hidden' name='id_producto' value='{$row['Cod_producto']}'>
                        <input type='hidden' name='cantidad' value='1'>
                        <button class='trollButton' name='anadir' type='submit'>AÑADIR AL CARRITO</button>
                      </form>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "Error al ejecutar la consulta.";
        }

    }

    ?>
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
                <h3>Información y Bases Legales</h3>
            </div>
            <div class="contenido">
                <a href="AboutUs.php">About Us</a>
                <a href="Newsletter.php">Newsletter</a>
                <a href="InfoLegal.php">Información Legal</a>
            </div>
        </div>
    </footer>
</body>

</html>