<?php
session_start();
require_once 'php/db.php';

if (isset($_SESSION['username'])) {
    $nombre_usuario = $_SESSION['username'];
    $query = "SELECT usuarios.Nombre FROM `usuarios` WHERE Correo='$nombre_usuario'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $nombre = $row['Nombre'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>NombreTienda</title>
    <link href="css/header.css" rel="stylesheet" type="text/css">
    <link href="css/carrusel.css" rel="stylesheet" type="text/css">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="imagenes/Header/Logo/Logo.svg" type="image/x-icon" />
    <link rel="icon" href="imagenes/Logos/Header/Logo.svg" type="image/x-icon" />
    <script src="javascript/carrusel.js"></script>
</head>


<body>
    <header>

        <div class="container">
            <div class="infoPag">
                <img src="imagenes/Header/Logo.svg" />
                NombreTienda
            </div>
            <form action="search.php" method="get">
                <div class="buscador">
                    <input type="text" name="query" placeholder="Buscar...">
                    <button type="submit">Buscar</button>
                </div>
            </form>
            <div class="menuPers">
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="#" class="user-menu">Bienvenido,
                        <?php echo $nombre; ?>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="#">Editar perfil</a></li>
                        <?php if (isset($_GET['logout'])) {
                            session_destroy();
                            header("Location: index.php");
                            exit;
                        } ?>
                        <li><a href="?logout">Desconectarse</a></li>
                    </ul>
                <?php else: ?>
                    <a href="#"> <img src="imagenes/Header/User.svg" />Iniciar Sesión</a>
                <?php endif; ?>
                <a href="#"><img src="imagenes/Header/Presupuesto.svg" />Presupuesto</a>
                <a href="#"><img src="imagenes/Header/Carrito.svg" />Pedido</a>
            </div>

        </div>
    </header>
    <nav>

        <div class="carousel">
            <div id="imagen"></div>
        </div>
    </nav>
    <div class="separador">
        CATEGORÍAS
    </div>
    <div class="categorias">
        <div class="item"><img src="imagenes/Menu/Techo.svg" />Tejados Y Cubiertas</div>
        <div class="item"><img src="imagenes/Menu/Cemento.svg" />Cementos Y Morteros</div>
        <div class="item"><img src="imagenes/Menu/Yeso.svg" />Yesos Y Escayolas</div>
        <div class="item"><img src="imagenes/Menu/Arena.svg" />Arenas y Gravas</div>
        <div class="item"><img src="imagenes/Menu/Valla.svg" />Cercados y Ocultación</div>
        <div class="item"><img src="imagenes/Menu/Madera.svg" />Madera</div>
        <div class="item"><img src="imagenes/Menu/Hormigonera.svg" />Hormigoneras, carretillas...</div>
        <div class="item"><img src="imagenes/Menu/Aislante.svg" />Aislamientos</div>
        <div class="item"><img src="imagenes/Menu/Eleconstruccion.svg" />Elementos de construcción</div>
    </div>
    <div class="separador">
        PRODUCTOS DESTACADOS
    </div>
    <div class="separador">
        NUESTROS COMPROMISOS
    </div>
    <footer>
        <div class="redes">
            <img src="imagenes/RRSS/facebook.svg" />
            <img src="imagenes/RRSS/twitter.svg" />
            <img src="imagenes/RRSS/youtube.svg" />
            <img src="imagenes/RRSS/instagram.svg" />
        </div>
        <div class="info">
            <a href="html/AboutUs.html">About Us</a>
            <a href="html/Newsletter.html">Newsletter</a>
            <a href="html/InfoLegal.html">Información Legal</a>
        </div>
    </footer>
</body>

</html>