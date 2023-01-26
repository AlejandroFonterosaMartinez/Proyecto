<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>BricoMark</title>
    <link href="css/header.css" rel="stylesheet" type="text/css">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="imagenes/Header/Logo/Logo.svg" type="image/x-icon" />
    <link rel="icon" href="imagenes/Logos/Header/Logo.svg" type="image/x-icon" />
    <script src="javascript/script.js"></script>
</head>
<style>
    .posicion {
        position: relative;
    }

    .account-menu {
        display: none;
        /* oculta el menú por defecto */
        position: absolute;
        top: 35px;
        /* posición debajo del enlace "Mi Cuenta" */
        left: 0;
        width: 150px;
        /* tamaño del cuadrado */
        padding: 10px;
        /* espaciado interno */
        background-color: #fff;
        /* color de fondo */
        border: 1px solid #ccc;
        /* borde */
        z-index: 1;
        /* coloca el menú por encima de otros elementos */
    }

    .account-menu a {
        display: block;
        /* muestra cada enlace como bloque */
        padding: 10px;
        /* espaciado interno */
        color: #000;
        /* color del texto */
        text-decoration: none;
        /* quita el subrayado */
    }
</style>

<body onload="addDropdownMenu()">
    <header>
        <div class="container">
            <div class="logo"><img src="imagenes/Header/Logo/Logo.svg" />Mi Sitio</div>
            <form class="search-form">
                <input type="text" placeholder="Buscar...">
                <button type="submit">Buscar</button>
            </form>

            <ul class="nav-links" >
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Contacto</a></li>
                <li  class="posicion"><a href="#" id="account-link">Mi Cuenta</a>
                    <div class="account-menu" id="account-menu" style="display:none; position:absolute; top:35px; left:0;">
                        <a href="#">Editar perfil</a>
                        <a href="#">Desconectarse</a>
                    </div>

                </li>
            </ul>

        </div>

    </header>
    <nav>
        <div class="carrusel">
            <div class="banner">
                <img src="imagenes/Logos/Banner/Banner_Ej.png" />
            </div>
        </div>
    </nav>
    <div class="categorias">
        <div class="item"><img src="imagenes/Logos/Menu/Techo.svg" />Tejados Y Cubiertas</div>
        <div class="item"><img src="imagenes/Logos/Menu/Cemento.svg" />Cementos Y Morteros</div>
        <div class="item"><img src="imagenes/Logos/Menu/Yeso.svg" />Yesos Y Escayolas</div>
        <div class="item"><img src="imagenes/Logos/Menu/Arena.svg" />Arenas y Gravas</div>
        <div class="item"><img src="imagenes/Logos/Menu/Valla.svg" />Cercados y Ocultación</div>
        <div class="item"><img src="imagenes/Logos/Menu/Madera.svg" />Madera</div>
        <div class="item"><img src="imagenes/Logos/Menu/Hormigonera.svg" />Hormigoneras, carretillas...</div>
        <div class="item"><img src="imagenes/Logos/Menu/Aislante.svg" />Aislamientos e impermeabilización</div>
        <div class="item"><img src="imagenes/Logos/Menu/Eleconstruccion.svg" />Elementos de construcción</div>
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