<?php
include('../Config/Conectar.php');
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

foreach ($resul as $valores) {
    $texto .= "<ul>";
    $texto .= "<li>" . $valores["Cod_producto"] . "</li>";
    $texto .= "<li>" . $valores["Nombre"] . "</li>";
    $texto .= "<li>" . $valores["Precio"] . "</li>";
    $texto .= "</ul>";
}
$output = $texto;
echo $output;
