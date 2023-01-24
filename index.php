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
    <script src="javascript/script.js"></script>

    <link rel="shortcut icon" href="imagenes/Header/Logo/Logo.svg" type="image/x-icon" />
    <link rel="icon" href="imagenes/Logos/Header/Logo.svg" type="image/x-icon" />
    <style>

    </style>
</head>

<body>

    <header>
        <div class="container">
            <div class="logo"><img src="imagenes/Header/Logo/Logo.svg" />Mi Sitio</div>
            <form class="search-form">
                <input type="text" placeholder="Buscar...">
                <button type="submit">Buscar</button>
            </form>

            <ul class="nav-links">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#" onmouseover="getcuentaInfo()">Mi Cuenta
                        <?php
                        // Connect to the database
                        $conn = new mysqli("localhost", "root", "", "construccion");
                        // Retrieve the account information from the database
                        $result = $conn->query("SELECT * FROM usuarios ");
                        $cuenta = $result->fetch_assoc();
                        // Return the cuenta information as a JSON object
                        echo json_encode($cuenta);
                        ?>
                    </a></li>
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