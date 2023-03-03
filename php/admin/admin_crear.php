<?php
include('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
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

echo "guardado";
