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

            <div class="buscador">
                <form action="search.php" method="get">
                    <div class="cajaTexto">
                        <input type="text" name="query" placeholder="Buscar...">
                        <button type="submit">Buscar</button>
                    </div>
                </form>
            </div>

            <div class="menuPers">
                <div class="cuenta"><a href="#"><img src="imagenes/Header/User.svg" />Mi cuenta</a>
                    <div class="submenu">
                        <div class="subdiv"><a href="#"></a>Editar Perfil</div>
                        <div class="subdiv"><a href="#"></a>Iniciar Sesión</div>
                    </div>
                </div>
                <div><a href="#"><img src="imagenes/Header/Presupuesto.svg" />Presupuesto</a></div>
                <div><a href="#"><img src="imagenes/Header/Carrito.svg" />Pedido</a></div>
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
        <div class="item"><img src="imagenes/Menu/Madera.svg" />Madera</div>
        <div class="item"><img src="imagenes/Menu/Arena.svg" />Arenas y Gravas</div>
        <div class="item"><img src="imagenes/Menu/Valla.svg" />Cercados y Ocultación</div>
        <div class="item"><img src="imagenes/Menu/Yeso.svg" />Yesos Y Escayolas</div>
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
    <div class="compromisos">
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Calidad.svg" />
                CALIDAD ÓPTIMA
                <p>Buscamos mejorar tu experiencia. Querémos ser más que una tienda de productos de construcción,
                    queremos formar parte de tus proyectos como una comunidad.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Cantidad.svg" />
                STOCK SIEMPRE DISPONIBLE
                <p>Nos esforzamos por mantener un amplio stock disponible para que siempre tengas lo que necesitas para
                    tus proyectos de construcción.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Precio.svg" />
                PRECIOS IMBATIBLES
                <p>Ofrecemos precios competitivos para garantizar que tengas acceso a materiales de alta calidad sin
                    sacrificar tu presupuesto.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Comunicacion.svg" />
                ATENCIÓN 24 HORAS
                <p>Estamos disponibles 24/7 para responder a tus preguntas y inquietudes sobre nuestros productos de
                    construcción. ¡No dudes en contactarnos!</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Velocidad.svg" />
                ENTREGAS RÁPIDAS
                <p>Brindamos un servicio de entrega rápido y eficiente para ser una parte integral en el éxito de tus
                    proyectos de construcción.</p>
            </div>
        </div>
    </div>
    <footer>
        <div class="redes">
            <img src="imagenes/Footer/RRSS/facebook.svg" />
            <img src="imagenes/Footer/RRSS/twitter.svg" />
            <img src="imagenes/Footer/RRSS/youtube.svg" />
            <img src="imagenes/Footer/RRSS/instagram.svg" />
        </div>
        <div class="info">
            <a href="php/AboutUs.php">About Us</a>
            <a href="php/Newsletter.php">Newsletter</a>
            <a href="php/InfoLegal.php">Información Legal</a>
        </div>
    </footer>
</body>

</html>