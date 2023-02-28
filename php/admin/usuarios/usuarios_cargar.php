<?php
include('../../../Config/Conectar.php');

$db = Conectar::conexion();

$sql = "SELECT * FROM usuarios";
$stmt = $db->prepare($sql);
$stmt->execute();


//$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
//$query = $con->query("SELECT * FROM productos");
//while ($valores = mysqli_fetch_array($query)) {
    //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
//    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
//    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
//}
$contador = 1;
$texto = "";
$productos = $stmt->execute();
while ($valores = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $texto .= "<tr id='fila" . $contador ."'>";
    $texto .= "<td readonly>" . $valores["id_usuario"] . "</td>";
    $texto .= "<td>" . $valores["Nombre"] . "</td>";
    $texto .= "<td>" . $valores["Apellidos"] . "</td>";
    $texto .= "<td>" . $valores["Correo"] . "</td>";
    $texto .= "<td>" . $valores["Telefono"] . "</td>";
    $texto .= "<td>" . $valores["id_rol"] . "</td>";
    $texto .= "<td><button type='button' id='btn' class='btn btn-info'>Editar</button></td>";
    $texto .= "<td><button type='button' class='btn btn-danger'>Borrar</button></td>";
    $texto .= "</tr>";
    $contador++;
}
$output =$texto;
echo $output;
?>