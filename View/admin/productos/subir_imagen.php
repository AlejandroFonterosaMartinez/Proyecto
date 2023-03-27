<?php
use Config\Conectar;

require_once('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
$conn = Conectar::conexion('BTadmin');
// Consulta SELECT para obtener el último valor autoincrementable
$sql = "SELECT Cod_producto,Categoria FROM productos ORDER BY Cod_producto DESC LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->execute();
// Obtener el último ID generado
//$last_id = $stmt->fetchColumn();
//$last_cat = $stmt->fetchColumn(1);
while($valores = $stmt->fetch(PDO::FETCH_ASSOC)){
	$last_id = $valores['Cod_producto'];
	$last_cat = $valores['Categoria'];
}
if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
	$nombre = $_FILES['file']['name'];
	$tipo = $_FILES['file']['type'];
	$tamaño = $_FILES['file']['size'];
	$tmp = $_FILES['file']['tmp_name'];

	$fileExt = explode('.', $nombre);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'jfif');

	if (in_array($fileActualExt, $allowed)) {
		if ($tamaño < 1000000000) {
			$fileNameNew = $last_id . ".png"; // Cambiar el nombre del archivo final
			$fileDestination = "../../../imagenes/Productos/Categorias/" . $last_cat;
			move_uploaded_file($tmp, "$fileDestination/$fileNameNew");
			echo 'Subido';
			echo $last_id;
			echo $last_cat;
		} else {
			echo "<script>console.log(Archivo demasiado grande)</script>";
		}
	} else {
		echo "<script>console.log(Tipo no compatible)</script>";
	}
}

?>