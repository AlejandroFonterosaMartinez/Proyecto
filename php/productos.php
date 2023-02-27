<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>BricoTeis SL</title>
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/infos.css" rel="stylesheet" type="text/css">
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
                     <div class="cuenta"><img src="../imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                             <div class="subdiv"><button><a href="php/registro.php"><img src="imagenes/Header/01Menu/register.svg" /><div class="subText">REGISTRARSE</div></a></button>
                             </div>
                             <div class="subdiv"><button><a href="php/login.php"><img src="imagenes/Header/01Menu/entrance.svg" /><div class="subText">INICIAR SESIÓN</div></a></button></div>
                         </div>
                     </div>
                     <div><img src="imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
                     <div><img src="imagenes/Header/01Menu/shopping-cart.svg" />Carrito</div>
                 </div>';
                } else {
                    echo '<div class="cuenta"><img src="imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                        <div class="subdiv"><button><a href="php/perfil.php"><img src="imagenes/Header/01Menu/edit.svg" /><div class="subText">EDITAR PERFIL</div></a></button>
                        </div>
                        <div class="subdiv"><button><a href="php/logout.php"><img src="imagenes/Header/01Menu/exit.svg" /><div class="subText">CERRAR SESIÓN</div></a></button> ';
                    echo '</div>
                    </div>
                </div>
                <div><img src="imagenes/Header/01Menu/heart.svg" />Favoritos</div>
                <div class="carrito"><img src="imagenes/Header/01Menu/shopping-cart.svg"/>Carrito
                    <div class="subcarrito">
                        <div class="carProd">Hola</div>
                        <div class="carProd">Hola</div>
                        <div class="carProd">Hola</div>
                    </div>
                </div>'
                    ;

                } ?>

            </div>
            </div>
    </header>

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
                <a href="../php/AboutUs.php">About Us</a>
                <a href="../php/Newsletter.php">Newsletter</a>
                <a href="../php/InfoLegal.php">Información Legal</a>
            </div>
        </div>
    </footer>
</body>

</html>