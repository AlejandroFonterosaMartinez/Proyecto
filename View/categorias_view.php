<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #f6f6f6;
        font-family: Roboto, sans-serif;
        -webkit-font-smoothing: antialiased;
    }

    .contenedor_productos {
        display: flex;
    }

    .producto {
        width: 40%;
        background-color: bisque;
    }
</style>


<body>
    <div class="contenedor_productos">
        <?php
        foreach ($array_categorias as $linea) {
            echo "<div class='producto'>" . $linea['Nombre'] . "</div>";
        }
        ?>
    </div>
</body>

</html>