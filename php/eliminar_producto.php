<?php
session_start();

if (isset($_SESSION['cart'])) {
    $clave_unica = $_POST['clave_unica'];
    foreach ($_SESSION['cart'] as $key => $producto) {
        if ($producto['clave_unica'] == $clave_unica) {
            unset($_SESSION['cart'][$key]);
        }
    }
}
header("Location: carrito.php");
exit;
?>