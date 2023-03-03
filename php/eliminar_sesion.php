<?php
session_start();

/**
 * Recibe la clave única del producto enviado desde JavaScript a través de una petición POST, busca el producto correspondiente en la variable de sesión 
 * "cart" y lo elimina usando la función "unset()". Luego, actualiza la variable "cart_count" en la sesión para reflejar el número actualizado de productos en el carrito.
 *
 * @var [type]
 */
$claveUnica = $_POST['clave_unica'];

// Buscar el producto con la clave única en la sesión y eliminarlo
foreach ($_SESSION['cart'] as $index => $producto) {
    if ($producto['claveUnica'] === $claveUnica) {
        unset($_SESSION['cart'][$index]);
        break;
    }
}

// Actualizar la variable cart_count en la sesión
$_SESSION['cart_count'] = count($_SESSION['cart']);