<?php

require_once("Model/categorias_modelo.php");

$categoria = new Categorias_model();
$array_categorias = $categoria->get_categorias();

require_once("View/categorias_view.php");

?>