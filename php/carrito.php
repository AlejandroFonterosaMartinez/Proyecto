<?php
require_once('../Config/Conectar.php');
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <h6>Mi Carrito</h6>
                    <hr>
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $total = 0;
                        $id_productos_en_carrito = array_column($_SESSION['cart'], 'Cod_producto');
                        $stmt = Conectar::conexion()->prepare("SELECT Cod_producto, Nombre, Precio FROM productos");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (!empty($result)) {
                            foreach ($result as $row) {
                                $indice = array_search($row['Cod_producto'], $id_productos_en_carrito);
                                if ($indice !== false) {
                                    $nombreproducto = $row['Nombre'];
                                    $cantidad = $_SESSION['cart'][$indice]['cantidad'];
                                    $precioproducto = $row['Precio'];
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
                                        <h5 class='pt-2 precio' id='precio_$clave_unica'>$precioproducto €/u</h5>
                                        <button type='submit' class='btn btn-warning btn-block'>Añadir a favoritos ❤</button>
                                        <form action='eliminar_producto.php' method='post'>
    <input type='hidden' name='clave_unica' value=' $clave_unica '> <button type='submit' class='btn btn-danger mx-2'>Borrar 🗑</button>
</form>

                                        <div class='row-md-3'>
                                            <input type='hidden' name='id_producto' value='$clave_unica'>
                                            <input type='number' id='cantidad_$clave_unica' name='cantidad_$clave_unica' value='$cantidad' class='text-center form-control w-25 d-inline cantidad' onchange='actualizarCantidad()'>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </form>";

                                    $total += $precioproducto * $cantidad;
                                }
                            }
                        }
                    } else {
                        echo "<h5>Carrito VACÍO!</h5>";
                    }
                    ?>

                    <script>
                        const cantidades = document.querySelectorAll('[id^="cantidad"]');
                        cantidades.forEach(cantidad => {
                            cantidad.onchange = actualizarCantidad;
                        });

                        function actualizarCantidad() {
                            const productos = document.querySelectorAll('[id^="prod_"]');
                            var suma = 0;
                            productos.forEach(element => {
                                const cantidad = element.querySelector('.cantidad').value;
                                const precio = element.querySelector('[id^="precio_"]').textContent;
                                suma += parseInt(cantidad) * parseFloat(precio);
                            });
                            document.getElementById('preciototal').innerHTML = suma.toFixed(2) + " €";
                        }

                        function borrarProduto($clave_unica) {

                        }


                    </script>

                    <div class="col-md-5">
                        <h6>Detalles del pedido</h6>
                        <hr>
                        <div class="row price-details">
                            <div class="col-md-6">
                                <h6> Precio de los
                                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> productos
                                </h6>
                                <h6> Total </h6>
                            </div>
                            <div class="col-md-6" id="preciototal">
                                <?php echo $total . "€"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <form>
</body>

</html>