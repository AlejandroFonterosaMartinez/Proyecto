<?php

require_once("Model/productos_modelo.php");

$producto = new Productos_model();
$array_productos = $producto->get_productos();

require_once("View/productos_view.php");

?>