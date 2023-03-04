<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
    $productos = cargar_producto($_GET['codigo']);
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
</body>
</html>