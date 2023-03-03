<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/productos.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="menuCat">
            <input type="button" class="categoria" value="Tejados Y Cubiertas" />
            <input type="button" class="categoria" value="Arenas y Gravas" />
            <input type="button" class="categoria" value="Cementos Y Morteros" />
            <input type="button" class="categoria" value="Madera" />
            <input type="button" class="categoria" value="Hormigoneras, carretillas..." />
            <input type="button" class="categoria" value="Cercados y Ocultación" />
            <input type="button" class="categoria" value="Yesos Y Escayolas" />
            <input type="button" class="categoria" value="Elementos de construcción" />
            <input type="button" class="categoria" value="Aislamientos" />
        </div>
        <div class="mostrar">
            <?php
            include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
            $productos = cargar_categorias($_GET['categoria']);

            foreach ($productos as $producto) {
                $cod = $producto['Cod_producto'];
                $nom = $producto['Nombre'];
                $pre = $producto['Precio'];
                /*
                 * Dentro del formulario hay un campo oculto para enviar el código del producto
                 * que debemos añadir al carro del la compra. El formulario llama al fichero anadir.php
                 */
                echo "<ul><li>$cod</li><li><img src='../imagenes/Productos/{$cod}.png'></img></li><li>$nom</li><li>$pre</li></ul>";
            }
            ?>
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
            <div class="contenido">
                <div class="menuCat">
                    <input type="button" class="categoria" value="Tejados Y Cubiertas" />
                    <input type="button" class="categoria" value="Arenas y Gravas" />
                    <input type="button" class="categoria" value="Cementos Y Morteros" />
                    <input type="button" class="categoria" value="Madera" />
                    <input type="button" class="categoria" value="Hormigoneras, carretillas..." />
                    <input type="button" class="categoria" value="Cercados y Ocultación" />
                    <input type="button" class="categoria" value="Yesos Y Escayolas" />
                    <input type="button" class="categoria" value="Elementos de construcción" />
                    <input type="button" class="categoria" value="Aislamientos" />
                </div>
                <div class="mostrar">
                    <?php
                    include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
                    $productos = cargar_categorias($_GET['categoria']);
                    echo "<div class='productos'>";
                    foreach ($productos as $producto) {
                        $cod = $producto['Cod_producto'];
                        $nom = $producto['Nombre'];
                        $pre = $producto['Precio'];
                        $precio_formateado = number_format($pre, 2);
                        /*
                         * Dentro del formulario hay un campo oculto para enviar el código del producto
                         * que debemos añadir al carro del la compra. El formulario llama al fichero anadir.php
                         */
                        echo "<div class='producto'>
                        <img src='../imagenes/Productos/{$cod}.png'></img>                   
                        <label>$nom</label>
                        <label>$precio_formateado €/Ud</label>
                        <div class='button'>
                        <form class='fav' method='post' action='favoritos.php'>
                        <input type='hidden' name='id_producto_fav' value='$cod'>
                          <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
                          </form>
                        <form class='troll' method='post' action='agregar_favoritos.php'>
                          <input type='hidden' name='id_producto' value='$cod'>
                          <input type='hidden' name='cantidad' value='1'>
                          <button class='trollButton' name='anadir' type='submit'>AÑADIR AL CARRITO</button>
                        </form>
                        </div>
                    </div>";
                    }
                    echo "</div>";
                    ?>
                </div>
                <script>
                    const editButtons = document.querySelectorAll(".categoria");
                    editButtons.forEach(editBtn => editBtn.addEventListener("click", () => select_productos(editBtn.value)));

                    function select_productos(value) {
                        console.log(value);
                        $.ajax({
                            data: {
                                "categoria": value
                            },
                            method: "POST",
                            url: "select_productos.php"
                        })
                            .done(function (response) {
                                console.log(response);
                                $("div.mostrar").html(response);
                                //document.getElementsByClassName('botoncito').addEventListener('click',mostrar);
                                //const editButtons = document.querySelectorAll(".btn-info");
                                //editButtons.forEach(editBtn => editBtn.addEventListener("click", () => mostrar(editBtn.parentNode)));

                            });
                    }
                </script>
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
                <script>
                    const editButtons = document.querySelectorAll(".categoria");
                    editButtons.forEach(editBtn => editBtn.addEventListener("click", () => select_productos(editBtn.value)));

                    function select_productos(value) {
                        console.log(value);
                        $.ajax({
                            data: {
                                "categoria": value
                            },
                            method: "POST",
                            url: "select_productos.php"
                        })
                            .done(function (response) {
                                console.log(response);
                                $("div.mostrar").html(response);
                                //document.getElementsByClassName('botoncito').addEventListener('click',mostrar);
                                //const editButtons = document.querySelectorAll(".btn-info");
                                //editButtons.forEach(editBtn => editBtn.addEventListener("click", () => mostrar(editBtn.parentNode)));

                            });
                    }
                </script>
        </div>

</body>

</html>