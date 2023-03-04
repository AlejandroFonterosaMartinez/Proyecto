<?php
session_start();
// Errores
ini_set('log_errors', 1);
ini_set('error_log', 'logs/error.log');

// Verificar si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    // Si el usuario no está logueado, establecer el rol en 3
    $_SESSION['rol'] = 3;
}

/**
 * Carrito
 */
if (!isset($_SESSION['cart_count'])) {
    $_SESSION['cart_count'] = 0;
}
if (isset($_POST['anadir'], $_POST['id_producto'], $_POST['cantidad'])) {
    // Verificar que los campos sean válidos
    $product_id = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    if (!$product_id || !$cantidad) {
        // Mostrar un mensaje de error si los campos son inválidos
        echo "Error: campos inválidos";
        exit;
    }

    // Inicializar el array del carrito si es necesario
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Buscar si el producto ya está en el carrito
    $product_index = array_search($product_id, array_column($_SESSION['cart'], 'Cod_producto'));

    if ($product_index !== false) {
        // Si el producto ya está en el carrito, actualizar la cantidad
        $_SESSION['cart'][$product_index]['cantidad'] += $cantidad;
        // Incrementar el contador del carrito
        $_SESSION['cart_count'] += $cantidad;
    } else {
        // Si el producto no está en el carrito, agregar un nuevo elemento
        $new_product = array(
            'Cod_producto' => $product_id,
            'cantidad' => $cantidad,
        );
        $_SESSION['cart'][] = $new_product;
        // Incrementar el contador del carrito
        $_SESSION['cart_count'] += $cantidad;
    }
}
?>
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
                             <div class="subdiv"><a href="../View/registro_view.php"><img src="../imagenes/Header/01Menu/edit.svg" />Registrarse</a>
                             </div>
                             <div class="subdiv"><a href="../View/login_view.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Iniciar Sesión</div></a>
                         </div>
                     </div>
                     <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
    <div class="carrito"><a href="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a>
                 </div>';
                require('contador_carrito.php');
            } else {
                echo '<div class="cuenta"><a href="#"></a><img src="../imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                        <div class="subdiv"><a href="../View/perfil_view.php"><img src="../imagenes/Header/01Menu/edit.svg" />Editar Perfil</a>
                        </div>
                        <div class="subdiv"><a href="../php/logout.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Cerrar Sesión ';

                echo '</div></a>
                    </div>
                </div>
                <div><a href="favoritos.php"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
    <div class="carrito"><a href="carrito.php"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a>'
                ;
                require('contador_carrito.php');
            } ?>
        </div>
</header>