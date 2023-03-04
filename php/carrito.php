<?php
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
include('header.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <title>Carrito de compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>


<body class="bg-light">
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <hr>
                    <h1 class="text-center">Mi Carrito</h1>
                    <hr>
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $total = 0;
                        $id_productos_en_carrito = array_column($_SESSION['cart'], 'Cod_producto');
                        $stmt = Conectar::conexion()->prepare("SELECT Cod_producto, Nombre, Precio, stock FROM productos");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (!empty($result)) {
                            foreach ($result as $row) {
                                $indice = array_search($row['Cod_producto'], $id_productos_en_carrito);
                                if ($indice !== false) {
                                    $nombreproducto = $row['Nombre'];
                                    $cantidad = $_SESSION['cart'][$indice]['cantidad'];
                                    $precioproducto = $row['Precio'];
                                    $stock = $row['stock'];
                                    $clave_unica = 'cantidad_' . $row['Cod_producto'];
                                    echo "<form action='carrito.php' method='post' class='cart-items'>
                                <div class='border rounded'>
                                    <div class='row bg-white'>
                                        <div class='col-md-3'>
                                            <img src='../imagenes/Productos/" . $row["Cod_producto"] . ".png' class='img-fluid'>
                                        </div>
                                        <div class='col-md-6' id='prod_$clave_unica'>
                                            <h5 class='pt-2'>$nombreproducto</h5>
                                            <small class='text-secondary'>Vendedor: BricoTeis SL</small>
                                            <p class='text-right'><small class='text-secondary'>Stock: $stock </small> </p>
                                            <h5 class='pt-2 precio' id='precio_$clave_unica'>$precioproducto €/u</h5>
                                            <div>
                                                <input type='hidden' name='clave_unica' value='$clave_unica'>
                                                <button type='button' id='borrar' class='btn btn-danger mx-2' onclick='eliminarProducto(event, \"$clave_unica\")'>Eliminar 🗑</button>
                                            </div>
                
                                            <div class='row-md-3'>
                                                <input type='hidden' name='id_producto' value='$clave_unica'>
                                                <input type='number' min='1' max='$stock' id='cantidad_$clave_unica' name='cantidad_$clave_unica' value='$cantidad' class='text-center form-control w-25 d-inline cantidad' onchange='actualizar_cantidad()'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>";
                                    $total += $precioproducto * $cantidad;

                                    // Si el botón "Eliminar" fue presionado, elimina el producto del carrito de la sesión
                                    if (isset($_POST['eliminar']) && $_POST['eliminar'] === $clave_unica) {
                                        unset($_SESSION['cart'][$indice]);
                                    }
                                }
                            }
                        }
                    } else {
                        echo "<h5>Carrito VACÍO!</h5>";
                    }
                    if (!isset($_SESSION['cart_count'])) {
                        $_SESSION['cart_count'] = 0;
                    }
                    ?>
                    <script src="../javascript/carrito.js"></script>
                    <div class="col-md-5">
                        <hr>
                        <h4>Detalles del pedido</h4>

                        <?php $cantidad_productos = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>

                        <div class="row price-details">
                            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                                <div class="col-md-6">
                                    <h6> Precio de los
                                        <?php echo count($_SESSION['cart']); ?> productos
                                    </h6>
                                    <h6> Total </h6>
                                </div>
                                <div class="col-md-6" id="preciototal">
                                    <?php echo isset($total) ? $total . "€" : "0€"; ?>
                                </div>
                                <?php if ($_SESSION['rol'] != 3) { ?>
                                    <form method="post" action="finalizar_compra.php">
                                        <input type="hidden" name="total" value="<?php echo isset($total) ? $total : 0; ?>">
                                        <input type="hidden" name="cantidad" value="<?php echo ($_SESSION['cart']); ?>">
                                        <input type="hidden" name="id_producto"
                                            value="<?php echo implode(',', $id_productos_en_carrito); ?>">
                                        <input type="hidden" name="cantidad_producto" value="<?php echo $cantidad; ?>">
                                        <input type="hidden" name="stock" value="<?php echo $stock; ?>">
                                        <input type="hidden" name="nombre_producto" value="<?php echo $nombreproducto; ?>">
                                        <input type="hidden" name="precio_producto" value="<?php echo $precioproducto; ?>">
                                        <button type="submit" class="btn btn-warning">Finalizar Compra</button>
                                    </form>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <p>Debes iniciar sesión para poder realizar una compra.</p>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <p>Debes tener productos en tu carrito para poder finalizar la compra.</p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>



                    </div>
                </div>
            </div>
        </div>
</body>

</html>