<?php
// Obtener los pedidos de la base de datos
use Config\Conectar;

include(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "Conectar.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Detalles del Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        

        /* Estilos para la tabla */
        .tabla-pedidos {
            width: 100%;
            margin-top: 20px;
        }

        .tabla-pedidos table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-pedidos th,
        .tabla-pedidos td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .tabla-pedidos th {
            background-color: #f2f2f2;
        }

        /* Estilos adicionales */
        .pedido-info {
            margin-bottom: 20px;
        }

        .pedido-info-item {
            margin-bottom: 10px;
        }

        .pedido-info-item label {
            font-weight: bold;
            margin-right: 5px;
        }

        .boton-volver {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    $num_pedido = $_POST['numero_pedido'];
    $usuario = $_POST['nombre_cliente'];
    try {
        $pdo = Conectar::conexion('BTadmin');
    } catch (PDOException $e) {
        echo 'Error al conectarse a la base de datos: ' . $e->getMessage();
        exit;
    }


    $sql = "SELECT pedidos.Cod_pedido, usuarios.Nombre AS nombre_cliente, productos.Nombre AS nombre_producto, pedidosproductos.Unidades, productos.Precio as precio_producto
    FROM pedidos
    INNER JOIN usuarios ON pedidos.Usuario = usuarios.id_usuario
    INNER JOIN pedidosproductos ON pedidos.Cod_pedido = pedidosproductos.Cod_pedido
    INNER JOIN productos ON pedidosproductos.Cod_producto = productos.Cod_producto
    WHERE pedidos.Cod_pedido = '$num_pedido'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $pedidos = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Muestra los detalles del pedido
    echo '<h1>Detalles del Pedido ' . $num_pedido . '</h1>';
    echo '<div class="pedido-info">';
    echo '<div class="pedido-info-item"><label>Cliente:</label><span>' . $usuario . '</span></div>';

    // Mostrar tabla de productos
    echo '<div class="tabla-pedidos">';
    echo '<table>';
    echo '<tr>';
    echo '<th>Producto</th>';
    echo '<th>Cantidad</th>';
    echo '<th>Precio</th>';
    echo '</tr>';
// Calcular el total
$total = 0;
foreach ($pedidos as $pedido) {
    $subtotal = $pedido['Unidades'] * $pedido['precio_producto'];
    $total += $subtotal;
}

foreach ($pedidos as $pedido) {
    echo '<tr>';
    echo '<td>' . $pedido['nombre_producto'] . '</td>';
    echo '<td>' . $pedido['Unidades'] . '</td>';
    echo '<td>' . $pedido['precio_producto'] . ' €</td>';
    echo '</tr>';
}
echo '<tr>';
echo '<td colspan="2"><strong>Total</strong></td>';
echo '<td style="color:green;"><strong>' . $total . ' €</strong></td>';
echo '</tr>';
echo '</table>';
echo '</div>';


    // Botón de volver atrás
    echo '<br>
    <a href="javascript:history.back()" class="boton-volver">Volver</a>';
    ?>

</body>

</html>