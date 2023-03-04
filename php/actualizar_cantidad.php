<?php
session_start();
foreach ($_SESSION['cart'] as $producto) {
    $cod_producto = $producto['Cod_producto'];

    $indice = array_search($cod_producto, array_column($_SESSION['cart'], 'Cod_producto'));
    if ($indice !== false) {
        $_SESSION['cart'][$indice]['cantidad']++;
        $_SESSION['cart_count'] = count($_SESSION['cart']);
    }
   
}
?>