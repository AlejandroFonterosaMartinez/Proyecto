<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>NombreTienda SL</title>
    <link href="css/header.css" rel="stylesheet" type="text/css">
    <link href="css/carrusel.css" rel="stylesheet" type="text/css">
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="imagenes/Logo.ico" type="image/x-icon" />
    <script src="javascript/carrusel.js"></script>
</head>


<body>
    <header>
        <div class="container">

            <div class="infoPag">
            <a href="index.php">
                <img src="imagenes/Header/Logo.svg" />
                NombreTienda SL
            </a>
            </div>


            <div class="buscador">
                <form action="search.php" method="get">
                    <div class="cajaTexto">
                        <form action="search.php" method="get">
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
                     <div class="cuenta"><img src="imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                             <div class="subdiv"><a href="php/registro.php"><img src="imagenes/Header/01Menu/edit.svg" />Registrarse</a>
                             </div>
                             <div class="subdiv"><a href="php/login.php"><img src="imagenes/Header/01Menu/entrance.svg" />Iniciar Sesión</div></a>
                         </div>
                     </div>
                     <div><a href="#"><img src="imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
                     <div><a href="#"><img src="imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a></div>
                 </div>';
                } else {
                    echo '<div class="cuenta"><a href="#"></a><img src="imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                        <div class="subdiv"><a href="php/perfil.php"><img src="imagenes/Header/01Menu/edit.svg" />Editar Perfil</a>
                        </div>
                        <div class="subdiv"><a href="php/logout.php"><img src="imagenes/Header/01Menu/entrance.svg" />Cerrar Sesión ';

                    echo '</div></a>
                    </div>
                </div>
                <div><a href="#"></a><img src="imagenes/Header/01Menu/heart.svg" />Favoritos</div>
                <div><a href="#"></a><img src="imagenes/Header/01Menu/shopping-cart.svg" />Carrito</div>'
                    ;

                } ?>

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
        <div class="item"><img src="imagenes/Menu/Arena.svg" />Arenas y Gravas</div>
        <div class="item"><img src="imagenes/Menu/Techo.svg" />Tejados Y Cubiertas</div>
        <div class="item"><img src="imagenes/Menu/Cemento.svg" />Cementos Y Morteros</div>
        <div class="item"><img src="imagenes/Menu/Madera.svg" />Madera</div>
        <div class="item"><img src="imagenes/Menu/Hormigonera.svg" />Hormigoneras, carretillas...</div>
        <div class="item"><img src="imagenes/Menu/Valla.svg" />Cercados y Ocultación</div>
        <div class="item"><img src="imagenes/Menu/Yeso.svg" />Yesos Y Escayolas</div>
        <div class="item"><img src="imagenes/Menu/Eleconstruccion.svg" />Elementos de construcción</div>
        <div class="item"><img src="imagenes/Menu/Aislante.svg" />Aislamientos</div>
    </div>
    <div class="separador">
        PRODUCTOS DESTACADOS
    </div>
    <?php
    require_once "Controller/productos_controlador.php";
    ?>

    <div class="separador">
        NUESTRA REVISTA
    </div>
    <div class="contenedorRevista">
        <img src="imagenes/revista.png" />
        <div class="textoRev">
            <h2>La Revista Nº1 de construcción</h2>
            <p>Descubre las últimas tendencias y novedades en construcción con la revista líder en el mercado.
                Este
                semana no te pierdas el apartado especial "Architect", con consejos de un arquitecto profesional
                para
                construir tu casa de sueños. ¡Consigue tu ejemplar!</p>
                <button type="submit">Añadir al carrito</button>
        </div>
    </div>
    <div class="separador">
        NUESTROS COMPROMISOS
    </div>
    <div class="compromisos">
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Calidad.svg" />
                CALIDAD ÓPTIMA
                <p>Buscamos mejorar tu experiencia. Querémos ser más que una tienda de productos de
                    construcción,
                    queremos formar parte de tus proyectos como una comunidad.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Cantidad.svg" />
                STOCK SIEMPRE DISPONIBLE
                <p>Nos esforzamos por mantener un amplio stock disponible para que siempre tengas lo que
                    necesitas para
                    tus proyectos de construcción.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Velocidad.svg" />
                ENTREGAS RÁPIDAS
                <p>Brindamos un servicio de entrega rápido y eficiente para ser una parte integral en el éxito
                    de tus
                    proyectos de construcción.</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Comunicacion.svg" />
                ATENCIÓN 24 HORAS
                <p>Estamos disponibles 24/7 para responder a tus preguntas y inquietudes sobre nuestros
                    productos de
                    construcción. ¡No dudes en contactarnos!</p>
            </div>
        </div>
        <div class="compromiso">
            <div class="comp"><img src="imagenes/Compromisos/Precio.svg" />
                PRECIOS IMBATIBLES
                <p>Ofrecemos precios competitivos para garantizar que tengas acceso a materiales de alta calidad
                    sin
                    sacrificar tu presupuesto.</p>
            </div>
        </div>
    </div>
    <footer>
        <div class="redes">
            <div class="titulo">
                <h3>Nuestras Redes Sociales</h3>
            </div>
            <div class="contenido">
                <img src="imagenes/Footer/RRSS/facebook.svg" />
                <img src="imagenes/Footer/RRSS/twitter.svg" />
                <img src="imagenes/Footer/RRSS/youtube.svg" />
                <img src="imagenes/Footer/RRSS/instagram.svg" />
                <img src="imagenes/Footer/RRSS/linkedin.svg" />
                <img src="imagenes/Footer/RRSS/pinterest.svg" />
            </div>
        </div>
        <div class="redes">
            <div class="titulo">
                <h3>Proyecto Ecológico</h3>
            </div>
            <div class="contenido">
                <a href="php/eco.php">
                    <img src="imagenes/Footer/ECO/Agua.svg" />
                    <img src="imagenes/Footer/ECO/Reciclaje.svg" />
                    <img src="imagenes/Footer/ECO/Renovable.svg" />
                </a>
            </div>
        </div>
        <div class="redes">
            <div class="titulo">
                <h3>Pago 100% Seguro</h3>
            </div>
            <div class="contenido">
                <img src="imagenes/Footer/Pago/Amex.svg" />
                <img src="imagenes/Footer/Pago/Klarna.svg" />
                <img src="imagenes/Footer/Pago/Mastercard.svg" />
                <img src="imagenes/Footer/Pago/Paypal.svg" />
                <img src="imagenes/Footer/Pago/Visa.svg" />
            </div>
        </div>
        <div class="redes">
            <div class="titulo">
                <h3>Información y Bases Legales</h3>
            </div>
            <div class="contenido">
                <a href="php/AboutUs.php">About Us</a>
                <a href="php/Newsletter.php">Newsletter</a>
                <a href="php/InfoLegal.php">Información Legal</a>
            </div>
        </div>
    </footer>
    <footer>
    </footer>
</body>

</html>