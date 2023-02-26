<?php
$con = mysqli_connect("localhost", "root", "", "construccion");
// Check connection
if (mysqli_connect_errno()) {
    echo "Error en la conexión a MySQL: " . mysqli_connect_error();
}



$cod = $_POST['cod'];

$query = $con->query("DELETE from productos WHERE Cod_producto='$cod'");
//$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
//$query = $con->query("SELECT * FROM productos");
//while ($valores = mysqli_fetch_array($query)) {
    //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
//    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
//    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
//}
echo "guardado";

?>