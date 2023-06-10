<?php
use Config\Conectar;

require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
$db = Conectar::conexion('BTadmin');
$sql = "SELECT Cod_producto,Nombre,Descripcion,Precio,Stock,Categoria,Descripcion_detallada,Destacado,Habilitado FROM productos";
$stmt = $db->prepare($sql);
if (!$stmt) {
    die("Error al preparar la consulta SQL.");
}
$stmt->execute();
$contador = 1;
$texto = "";
while ($valores = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $texto .= "<tr id='fila" . $contador . "'>";
    $texto .= "<td readonly>" . $valores["Cod_producto"] . "</td>";
    $texto .= "<td>" . $valores["Nombre"] . "</td>";
    $texto .= "<td>" . $valores["Descripcion"] . "</td>";
    $texto .= "<td>" . $valores["Precio"] . "</td>";
    $texto .= "<td>" . $valores["Stock"] . "</td>";
    $texto .= "<td>" . $valores["Categoria"] . "</td>";
    $texto .= "<td>" . $valores["Descripcion_detallada"] . "</td>";
    if($valores['Destacado'] == 0){
        $texto .= "<td><button type='button' class='btn btn-outline-info'>Añadir</button></td>";
    }else{
        $texto .= "<td><button type='button' class='btn btn-outline-danger'>Quitar</button></td>";
    }
    $texto .= "<td><button type='button' id='btn' class='btn btn-info'>Editar</button></td>";
    if($valores['Habilitado'] == 0){
        $texto .= "<td><button type='button' class='btn btn-outline-warning'>Habilitar</button></td>";
    }else{
        $texto .= "<td><button type='button' class='btn btn-danger'>Deshabilitar</button></td>";
    }
    
    $texto .= "</tr>";
    $contador++;
}
$output = $texto;
echo $output;