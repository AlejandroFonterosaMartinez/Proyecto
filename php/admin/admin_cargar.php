<?php
$con = mysqli_connect("localhost", "root", "", "construccion");
// Check connection
if (mysqli_connect_errno()) {
    echo "Error en la conexión a MySQL: " . mysqli_connect_error();
}

function selectCategorias($con){
    $query = $con->query("SELECT * FROM productos");
    return $query;
}


//$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
//$query = $con->query("SELECT * FROM productos");
//while ($valores = mysqli_fetch_array($query)) {
    //echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
//    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
//    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
//}
$contador = 1;
$texto = "";
$productos = selectCategorias($con);
while ($valores = mysqli_fetch_array($productos)) {
    $texto .= "<tr id='fila" . $contador ."'>";
    $texto .= "<td readonly>" . $valores["Cod_producto"] . "</td>";
    $texto .= "<td>" . $valores["Nombre"] . "</td>";
    $texto .= "<td>" . $valores["Descripcion"] . "</td>";
    $texto .= "<td>" . $valores["Precio"] . "</td>";
    $texto .= "<td>" . $valores["Stock"] . "</td>";
    $texto .= "<td>" . $valores["Categoria"] . "</td>";
    $texto .= "<td>" . $valores["Descripcion_detallada"] . "</td>";
    if($valores["Destacado"] == 1){
        $texto .= "<td>SI</td>";
    }else{
        $texto .= "<td>NO</td>";
    }
    $texto .= "<td><button type='button' id='btn' class='btn btn-info'>Editar</button></td>";
    $texto .= "<td><button type='button' class='btn btn-danger'>Borrar</button></td>";
    $texto .= "</tr>";
    $contador++;
}
$output =$texto;
echo $output;
?>