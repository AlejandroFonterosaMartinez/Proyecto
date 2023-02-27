<?php
include("../Config/Conexion.php");
session_start();
// Obtener el ID del producto que se va a agregar a favoritos
$Cod_producto = $_POST['Cod_producto'];
// Verificar si ya se ha agregado a favoritos
if (!isset($_SESSION['favoritos'])) {
    $_SESSION['favoritos'] = array();
}
foreach ($_SESSION['favoritos'] as $favorito) {
    if ($favorito['Cod_producto'] == $Cod_producto) {
        // El producto ya está en favoritos, redirigir al usuario a la página de favoritos
        header('Location: favoritos.php');
        exit;
    }
}
// Agregar el producto a favoritos
$stmt = Conectar::conexion()->prepare("SELECT Cod_producto, Nombre, Precio FROM productos WHERE Cod_producto = ?");
$stmt->execute(array($Cod_producto));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result) {
    $_SESSION['favoritos'][] = $result;
}
// Redirigir al usuario a la página de favoritos
header('Location: favoritos.php');
exit;
?>