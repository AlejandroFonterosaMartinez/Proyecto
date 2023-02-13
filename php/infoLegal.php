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
                             <div class="subdiv"><a href="../php/registro.php"><img src="../imagenes/Header/01Menu/edit.svg" />Registrarse</a>
                             </div>
                             <div class="subdiv"><a href="../php/login.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Iniciar Sesión</div></a>
                         </div>
                     </div>
                     <div><a href="#"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
                     <div><a href="#"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a></div>
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
                <div><a href="#"></a><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</div>
                <div><a href="#"></a><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</div>'
                    ;

                } ?>

            </div>
    </header>
    <div class="apartados">
        <div class="titulo">
            <h1>Información Legal</h1>
        </div>
        <div class="apartado">
            <h2>Política de privacidad de BricoTeis SL</h2>
            <p>Nos comprometemos a proteger su privacidad y a garantizar que sus datos personales sean tratados de
                manera
                confidencial y segura. Esta política describe cómo recopilamos, usamos, compartimos y protegemos sus
                datos
                personales.</p>
        </div>
        <div class="apartado">
            <h2>Recopilación de datos</h2>
            <p>Recopilamos información sobre usted en varias ocasiones, como cuando se registra en nuestro sitio web,
                realiza una compra o se suscribe a nuestro boletín informativo. La información que recogemos incluye su
                nombre, dirección de correo electrónico, dirección postal, número de teléfono y detalles de pago, entre
                otros. También podemos recopilar información adicional sobre sus preferencias y intereses para mejorar
                su experiencia en línea y personalizar nuestros servicios y promociones. Todos los datos que recogemos
                se utilizan únicamente con fines internos y siempre respetamos su privacidad según lo establecido en
                nuestra política de privacidad.</p>
        </div>
        <div class="apartado">
            <h2>Uso de datos</h2>
            <p>Nos comprometemos a utilizar su información de manera responsable y efectiva. Utilizamos su información
                para procesar sus compras y mejorar su experiencia en línea en nuestro sitio web. Además, podemos
                enviarle información sobre ofertas especiales, promociones y novedades que puedan ser de su interés.
                También utilizamos su información para personalizar su experiencia en línea, lo que incluye la
                recomendación de productos y servicios que puedan ser de su interés. Por último, utilizamos su
                información para mejorar continuamente nuestro sitio web y nuestro servicio al cliente. Todo esto se
                realiza de acuerdo con las leyes aplicables y nuestra política de privacidad.</p>
        </div>
        <div class="apartado">
            <h2>Compartir información</h2>
            <p>Valoramos su privacidad y, por lo tanto, nos comprometemos a proteger su información personal. En
                general, no venderemos ni compartiremos su información con terceros a menos que sea necesario para
                llevar a cabo una transacción solicitada por usted o para cumplir con cualquier ley aplicable. Sin
                embargo, puede haber situaciones en las que debamos compartir su información con terceros confiables
                para fines de procesamiento de pagos, envío de correo electrónico o mejorar nuestro servicio. En estos
                casos, tomaremos medidas para garantizar que su información sea tratada de manera confidencial y segura.
            </p>
        </div>
        <div class="apartado">
            <h2>Seguridad de datos</h2>
            <p>Nos tomamos muy en serio la seguridad de su información personal y es por eso que implementamos
                medidas rigurosas de seguridad para proteger sus datos de acceso no autorizado, alteración, divulgación
                o destrucción. Estas medidas incluyen el cifrado de datos sensibles, la autenticación de usuarios,
                controles de acceso restringido y copias de seguridad regulares. Además, trabajamos continuamente para
                evaluar y mejorar nuestras medidas de seguridad para asegurarnos de que su información esté siempre
                protegida. </p>
        </div>
        <div class="apartado">
            <h2>Cookies</h2>
            <p>En nuestro sitio web, utilizamos cookies con el objetivo de mejorar su experiencia de navegación y
                personalizar su experiencia en línea. Las cookies son pequeños archivos de texto que se guardan en su
                dispositivo (computadora o móvil) cuando visita un sitio web. Nos permiten recopilar información sobre
                sus preferencias de navegación y, en consecuencia, mejorar su experiencia en línea ofreciéndole
                contenido y anuncios relevantes. Además, también nos ayudan a mantener un seguimiento de sus visitas y
                comportamiento en el sitio para que podamos mejorar nuestros servicios y ofrecerle una experiencia más
                fluida y personalizada. Puede configurar su navegador para rechazar las cookies si lo desea, pero tenga
                en cuenta que esto puede afectar la funcionalidad de nuestro sitio web. </p>
        </div>
        <div class="apartado">
            <h2>Términos y condiciones</h2>
            <p>Al usar nuestro sitio web, acepta nuestros términos y condiciones, que incluyen esta política de
                privacidad.
                Nos reservamos el derecho de modificar esta política en cualquier momento, por lo que le recomendamos
                que la
                revise periódicamente.</p>
            <p>Además, al utilizar nuestro sitio web, acepta no utilizarlo con fines ilícitos ni para dañar a terceros.
                También se compromete a no hacer uso indebido de nuestra información y a no realizar cualquier acción
                que
                pueda afectar el correcto funcionamiento de nuestro sitio web.</p>
            <p>Nos reservamos el derecho de rechazar o cancelar cualquier pedido sin explicación y de limitar o prohibir
                el
                acceso a nuestro sitio web a cualquier persona o entidad en cualquier momento.</p>
            <p>Si tiene alguna pregunta o inquietud sobre esta política de privacidad y términos de uso, no dude en
                ponerse
                en contacto con nosotros a través de nuestro correo electrónico o número de teléfono.</p>
        </div>
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
                <h3>Información y Bases Legales</h3>
            </div>
            <div class="contenido">
                <a href="../php/aboutUs.php">About Us</a>
                <a href="../php/Newsletter.php">Newsletter</a>
                <a href="../php/infoLegal.php">Información Legal</a>
            </div>
        </div>
    </footer>
</body>

</html>