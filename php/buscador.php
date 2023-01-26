<?php
require_once "bd.php";
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Busqueda en la bd
    $result = mysqli_query($con, "SELECT * FROM productos WHERE Nombre.producto LIKE '%$query%' OR Descripcion.producto LIKE '%$query%' UNION SELECT * FROM categorias WHERE Nombre.categoria LIKE '%$query%'");
    // Muestra los resultados
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['Nombre.producto'];
        echo $row['Descripcion.producto'];
        echo $row['Nombre.categoria'];
    }
}
?>