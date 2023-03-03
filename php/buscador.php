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
</head>


<body>
    <header>
        <div class="container">

            <div class="infoPag">
                <a href="../index.php">
                    <img src="../imagenes/Header/Logo.svg" />
                    BricoTeis SL
                </a>
            </div>

            <div class="buscador">
                <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="cajaTexto">
                        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="cajaTexto">
                                <input type="text" name="query" name="query" placeholder="Buscar...">
                                <button type="submit">Buscar</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>

            <div class="menuPers">
                <?php if (!isset($_SESSION['correo'])) {
                    echo '
                     <div class="cuenta"><img src="../imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                             <div class="subdiv"><a href="../php/registro.php"><img src="../imagenes/Header/01Menu/edit.svg" />Registrarse</a>
                             </div>
                             <div class="subdiv"><a href="../php/login.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Iniciar Sesión</div></a>
                         </div>
                     </div>
                     <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
    <div class="carrito"><a href="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a>
                 </div>';
                } else {
                    echo '<div class="cuenta"><a href="#"></a><img src="../imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                        <div class="subdiv"><a href="../php/perfil.php"><img src="../imagenes/Header/01Menu/edit.svg" />Editar Perfil</a>
                        </div>
                        <div class="subdiv"><a href="../php/logout.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Cerrar Sesión ';

                    echo '</div></a>
                    </div>
                </div>
                <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
    <div class="carrito"><a href="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a>'
                    ;

                } ?>

            </div>
    </header>
    <?php
    // Conectar a la base de datos
    session_start();
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
                    $precio_formateado = number_format($row["Precio"], 2);
                    echo "<div class='producto'>";
                    echo "<img src='../imagenes/Productos/" . $row["Cod_producto"] . ".png'>";
                    echo "<label>" . $row['Nombre'] . "</label>";
                    echo "<label>" . $precio_formateado . "€/Ud</label>";
                    echo "<div class='button'>";
                    echo "<form class='fav' method='post' action='favoritos.php'>
                            <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
                            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
                          </form>
                            <form class='troll' method='post' action='agregar_favoritos.php'>
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