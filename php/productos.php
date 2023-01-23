<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $con = mysqli_connect("localhost", "root", "", "construccion");
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Error en la conexión a MySQL: " . mysqli_connect_error();
        }

        $query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
        //$query = $con->query("SELECT * FROM productos");
        while ($valores = mysqli_fetch_array($query)) {
            //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
            echo "<img src='imagenes/" . $valores["Cod_producto"] . ".png' border='0' width='300' height='100'>";
            echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
        }
        ?>
    </body>
</html>
