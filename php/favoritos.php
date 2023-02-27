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
    <title>Favoritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <h2>Favoritos</h2>
        <?php
        if (isset($_SESSION['favoritos'])) {
            // Obtener los IDs de los productos favoritos
            $id_productos_en_favoritos = array_column($_SESSION['favoritos'], 'Cod_producto');
            // Obtener los detalles de los productos favoritos
            $stmt = Conectar::conexion()->prepare("SELECT Cod_producto, Nombre, Precio FROM productos WHERE Cod_producto IN (" . implode(',', $id_productos_en_favoritos) . ")");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                foreach ($result as $row) {
                    $nombreproducto = $row['Nombre'];
                    $precioproducto = $row['Precio'];
                    ?>
                    <form class='cart-items' id='form-<?php echo $row["Cod_producto"]; ?>'>
                        <div class='border rounded'>
                            <div class='row bg-white'>
                                <div class='col-md-3'>
                                    <img src='../imagenes/Productos/<?php echo $row["Cod_producto"]; ?>.png' class='img-fluid'>
                                </div>
                                <div class='col-md-6'>
                                    <h5 class='pt-2'>
                                        <?php echo $nombreproducto; ?>
                                    </h5>
                                    <h5 class='pt-2 precio'>
                                        <?php echo $precioproducto; ?> €/u
                                    </h5>
                                    <button type='submit' class='btn btn-warning btn-block'>AÑADIR AL CARRITO</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            } else {
                echo "No hay productos favoritos";
            }
        } else {
            echo "No hay productos favoritos";
        }
        ?>
    </div>
</body>

</html>