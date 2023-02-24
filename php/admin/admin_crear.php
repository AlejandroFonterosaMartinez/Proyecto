<?php
include('../../Config/Conectar.php');
/*
* Devuelve un puntero con el código y nombre de las categorías de la BBDD
* o falso si se produjo un error
*/

$db = Conectar::conexion();

$nom = $_POST['nombre'];
$des = $_POST['descripcion'];
$pre = $_POST['precio'];
$stk = $_POST['stock'];
$cat = $_POST['categoria'];
$dsD = $_POST['descripcionD'];
$dsT = $_POST['destacado'];


//$query = "INSERT INTO productos(Nombre, Descripcion, Precio, Stock, Categoria, Descripcion_detallada, Destacado) VALUES ('NUEV12O2','NUEVO2','11','11','1','NUEVO','0')";
//$query = "SELECT * FROM productos";
//$stmt = $db->prepare($query);
//$stmt->execute();

//$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

//foreach ($resultados as $row) {
//    echo $row['Cod_producto'] . ' ' . $row['Nombre'] . ' ' . $row['Precio'] . '<br>';
//}




$query = "INSERT INTO productos (Nombre, Descripcion, Precio, Stock,Categoria,Descripcion_detallada,Destacado)
    VALUES (:nombre, :descripcion, :precio, :stock, :categoria, :descripcion_detallada, :destacado)";

$stmt = $db->prepare($query);

$stmt->bindParam(':nombre', $nom);
$stmt->bindParam(':descripcion', $des);
$stmt->bindParam(':precio', $pre);
$stmt->bindParam(':stock', $stk);
$stmt->bindParam(':categoria', $cat);
$stmt->bindParam(':descripcion_detallada', $dsD);
$stmt->bindParam(':destacado', $dsT);
$stmt->execute();


//$query = $con->query("SELECT * FROM productos WHERE Cod_producto='8'");
//$query = $con->query("SELECT * FROM productos");
//while ($valores = mysqli_fetch_array($query)) {
//echo '<img src="C:\xampp\htdocs\pruebas\imagenes' . $valores["Cod_producto"] . 'png">';
//    echo "<img src='imagenes/" . $valores["Cod_producto"] .".png' border='0' width='300' height='100'>"; 
//    echo '<label>' . $valores["Cod_producto"] . '</label>' . '<label>' . $valores["Nombre"] . '</label><br>';
//}
echo "guardado";
