<?php
use Config\Conectar;

include('sesion.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');

if (isset($_POST['id_producto_fav'])) {
    $con = Conectar::conexion('busuario');
    $id_producto = $_POST['id_producto_fav'];
    $usuario_id = $_SESSION['usuario'];

    // Verificar si el producto ya está en la tabla de favoritos
    $query = "SELECT COUNT(*) AS count FROM favoritos WHERE id_producto = :id_producto AND usuario_id = :usuario_id";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] == 0) {
        // Insertar el producto en la tabla de favoritos
        $query = "INSERT INTO favoritos (id_producto, usuario_id) VALUES (:id_producto, :usuario_id)";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <link href="../css/general.css" rel="stylesheet" type="text/css">
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</head>
<style>
    .btn-custom {
        background-color: #00b3aa;
        color: #00b3aa;
    }

    .btn-custom:hover {
        background-color: #00b3aa;
        color: #00b3aa;
    }

    #col-botones {
        height: 50px;
    }
</style>

<body class="bg-light">
    <div class="container-fluid">

        <?php
        include('header.php');
        $con = Conectar::conexion('busuario');

        if (isset($_SESSION['usuario'])) {
            $usuario_id = $_SESSION['usuario'];

            // Obtener detalles de los productos en favoritos desde la tabla "favoritos"
            $query = "SELECT p.Cod_producto, p.nombre, p.Categoria, p.precio, p.descripcion
              FROM favoritos AS f
              JOIN productos AS p ON f.id_producto = p.Cod_producto
              WHERE f.usuario_id = :usuario_id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->execute();
            $favoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Productos Favoritos</h2>";

            // Mostrar productos en favoritos
            if (count($favoritos) > 0) {
                foreach ($favoritos as $producto) {
                    $cod = $producto['Cod_producto'];

                    echo "<table class='table text-center'>";
                    echo "<thead><tr><th class='col-1'>Imagen</th><th class='col-1'>Nombre</th><th class='col-1'>Descripción</th><th class='col-1'>Precio</th><th class='col-1'></th></tr></thead>";
                    echo "<tbody>";
                    echo "<tr><td class='col-1'><img class='img-fluid' style='width:150px;' src='../imagenes/Productos/Categorias/{$producto['Categoria']}/$cod.png'></img> </td><td class='col-1'>{$producto['nombre']}</td><td class='col-1'>{$producto['descripcion']}</td><td class='col-1'>{$producto['precio']}€</td>";
                    echo "<td class='col-1'>";
                    // Formulario para eliminar el producto de favoritos
                    echo "<form method='post' action='eliminar_favorito.php'>";
                    echo "<input id='col-botones' type='hidden' name='eliminar_fav' value='{$producto['Cod_producto']}' />";
                    echo "<button type='submit' class='btn btn-danger'>🗑️</button>";
                    echo "</form>";
                    echo "</td></tr>";
                    echo "</tbody>";
                    echo "</table>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                No hay productos en favoritos.
              </div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            No hay productos en favoritos.
          </div>";
        }
        ?>

    </div>
</body>

</html>
