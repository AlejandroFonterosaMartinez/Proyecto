<?php
session_start();
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'login_modelo.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
insertar_pedido($_SESSION['cart'], random_num());
$nombre = getNombreUsuario($_SESSION['correo']);

// Datos de ejemplo para la lista de productos
// Agregar cada producto enviado por el formulario
var_dump($_SESSION['cart']);
if (isset($_POST['cantidad'])) {
    $cantidad_productos = $_SESSION['cart'];
    // Recorrer los productos en el carrito y obtener la cantidad correspondiente
    foreach ($cantidad_productos as $producto_carrito) {
        $cod_producto = $producto_carrito['Cod_producto'];
        $cantidad_producto = $producto_carrito['cantidad'];

    }

    /*
    $nombre_producto = $_POST['nombre_producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $precio_producto = $_POST['precio_producto'];
    $total_producto = $_POST['total'];
    */

}
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">

<body>
    <div class="container">
        <div class="header">
            <img src="../imagenes/Logo.ico" alt="Logo" class="logo">
            <div class="info">
                <p>BricoTeis SL</p>
                <p>CIF: B12345678</p>
                <p>Dirección: Teis, 12</p>
                <p>Teléfono: 777 666 777</p>
            </div>
        </div>
        <table>
            <tr>
                <th>Cliente:</th>
                <td>
                    <?php echo $nombre ?>
                </td>
            </tr>
            <tr>
                <th>Fecha:</th>
                <td>
                    <?php echo date("Y-m-d") ?>
                </td>
            </tr>
            <tr>
                <th>Número de factura:</th>
                <td>
                    <?php echo random_num() ?>
                </td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Total</th>
            </tr>
            <tr>
                <?php foreach ($cantidad_productos as $producto_carrito) {
                    $cod_producto = $producto_carrito['Cod_producto'];
                    $cantidad_producto = $producto_carrito['cantidad'];
                    $precio_producto = $_POST['precio_producto'];
                    $total_producto = $cantidad_producto * $precio_producto;
                    ?>
                    <td>
                        <?php echo $cod_producto; ?>
                    </td>
                    <td>
                        <?php echo $cantidad_producto; ?>
                    </td>
                    <td>
                        <?php echo $precio_producto; ?>
                    </td>
                    <td>
                        <?php echo $total_producto;
                } ?>
                </td>
            </tr>
        </table>


        <div class="total">
            <span>Total:</span>
            <strong>
                <?php echo $total . "€"; ?>
            </strong>
        </div>


        <div class="legal">
            <p>Este documento es una factura electrónica y tiene la misma validez legal que una factura en papel.
            </p>
            <p>Powered by BricoTeis SL</p>
        </div>
    </div>
</body>

</html>




<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Finalizar pedido</title>
    <link href="../css/finalizar_compra.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</head>