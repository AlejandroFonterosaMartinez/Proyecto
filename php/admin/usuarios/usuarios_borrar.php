<?php


include('../../../Config/Conectar.php');
/*
* Devuelve un puntero con el código y nombre de las categorías de la BBDD
* o falso si se produjo un error
*/

$db = Conectar::conexion();

$id = $_POST['id'];

$sql = "DELETE FROM usuarios WHERE id_usuario = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

//$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
//$query = $con->query("SELECT * FROM productos");
//while ($valores = mysqli_fetch_array($query)) {
    //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
//    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
//    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
//}
echo "guardado";

?>