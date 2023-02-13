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
                                if (in_array($row['Cod_producto'], $id_productos_en_carrito)) {
                                    $nombreproducto = $row['Nombre'];
                                    $precioproducto = $row['Precio'];

                                    echo "<form action='carrito.php' method='get' class='cart-items'>
                                    <div class='border rounded'>
                                    <div class='row bg-white'>
                                    <div class='col-md-3'>
                                    <img src='../imagenes/Productos/" . $row["Cod_producto"] . ".png' class='img-fluid'>
                                    </div>
                                    <div class='col-md-6'>
                                    <h5 class='pt-2'>" . $nombreproducto . "</h5>
                                    <small class='text-secondary'>Vendedor: BricoTeis SL</small>
                                    <h5 class='pt-2'>" . $precioproducto . " €</h5>
                                    <button type='submit' class='btn btn-warning btn-block'>Guardar para más tarde</button>
                                    <button type='submit' class='btn btn-danger mx-2' name='borrar'>Borrar</button>
                                    </div>
                                    <div class='col-md-3 py-5'>
                                    <button type='button' class='btn btn-light border rounded circle'>-</button>
                                    <input type='text' value='1' class='text-center form-control w-25 d-inline text'>
                                    <button type='button' class='btn btn-light border rounded circle'>+</button>
                                    </div>
                                    </div>
                                    </div>
                                    </form>";
                                    $total += $precioproducto;
                                }
                            }
                        } else {
                            echo "<h5>No se ha encontrado ningún producto en la base de datos</h5>";
                        }
                    } else {
                        echo "<h5>Carrito VACÍO!</h5>";
                    }
                    ?>
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
                            <div class="col-md-6">
                                <?php echo $total . "€"; ?>
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