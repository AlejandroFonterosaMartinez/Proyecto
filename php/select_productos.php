<?php
include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
/*
 * Devuelve un puntero con el código y nombre de las categorías de la BBDD
 * o falso si se produjo un error
 */

$db = Conectar::conexion();
$cat = $_POST['categoria'];
switch ($cat) {
    case "Tejados Y Cubiertas":
        $cat = 1;
        break;
    case "Cementos Y Morteros":
        $cat = 2;
        break;
    case "Yesos Y Escayolas":
        $cat = 3;
        break;
    case "Arenas y Gravas":
        $cat = 4;
        break;
    case "Cercados y Ocultación":
        $cat = 5;
        break;
    case "Madera":
        $cat = 6;
        break;
    case "Hormigoneras, carretillas...":
        $cat = 7;
        break;
    case "Aislamientos":
        $cat = 8;
        break;
    case "Elementos de construcción":
        $cat = 9;
        break;
}
$ins = "SELECT Cod_producto,Nombre,Precio FROM productos WHERE Categoria='$cat'";
$resul = $db->query($ins);
$texto = '';
$texto .= "<div class='productos'>";
foreach ($resul as $row) {
    $precio_formateado = number_format($row["Precio"], 2);
    $texto .= "<div class='producto'>";
    $texto .= "<img src='../imagenes/Productos/{$row['Cod_producto']}.png'></img>";
    $texto .= "<label>" . $row["Nombre"] . "</label>";
    $texto .= "<label>" . $precio_formateado . "</label>";
    $texto .= "<div class='button'>
        <form method='post' action='favoritos.php'>
            <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
        </form>
        <form class='troll' method='post'>
        <input type='hidden' name='id_producto' value='{$row['Cod_producto']}'>
        <input type='hidden' name='cantidad' value='1'>
        <button class='trollButton' name='anadir' type='submit'>AÑADIR AL CARRITO</button>
      </form>
    </div>";
    $texto .= "</div>";
}
$texto .= "</div>";
$output = $texto;
echo $output;