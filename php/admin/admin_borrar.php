<?php
include('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
// Check connection
$con = Conectar::conexion();
$cod = $_POST['cod'];

$query = $con->query("DELETE from productos WHERE Cod_producto='$cod'");

echo "guardado";

?>