<?php 

use Config\Conectar;

require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
$db = Conectar::conexion('BTadmin');

$sql = "SELECT * FROM categorias";
$stmt = $db->prepare($sql);
if (!$stmt) {
    die("Error al preparar la consulta SQL.");
}
$stmt->execute();

$contador = 1;
$texto = "";
while ($valores = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $texto .= "<option value=" . $valores["Cod_categoria"] .">" . $valores["Nombre"] . "</option>";
    $contador++;
}
$output = $texto;
echo $output;