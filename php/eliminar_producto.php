<?php
session_start();

if (isset($_POST['clave_unica'])) {
    $clave_unica = $_POST['clave_unica'];

    // Verificar que la clave única es válida y está en la sesión del carrito
    if (isset($_SESSION['cart']) && array_key_exists($clave_unica, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$clave_unica]); // Eliminar el producto del carrito
    }

    // Actualizar la vista del carrito
    include('mostrar_carrito.php');
} else {
    // Si no se proporcionó una clave única, devolver un mensaje de error
    echo "Error: No se proporcionó una clave única";
}
?>