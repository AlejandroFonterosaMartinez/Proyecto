<?php
include('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');

$con = Conectar::conexion();
function selectCategorias($con)
{
    $query = $con->query("SELECT * FROM productos");
    return $query;
}

$cod = $_POST['cod'];
$nom = $_POST['nombre'];
$des = $_POST['descripcion'];
$pre = $_POST['precio'];
$stk = $_POST['stock'];
$cat = $_POST['categoria'];
$dsD = $_POST['descripcionD'];
$dsT = $_POST['destacado'];

$query = $con->query("UPDATE productos SET Nombre='$nom', Descripcion='$des', Precio='$pre', Stock='$stk', Categoria='$cat', Descripcion_detallada='$dsD' ,Destacado='$dsT' WHERE Cod_producto='$cod'");
echo "guardado";

?>