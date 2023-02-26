<?php
// Conectar a la base de datos
session_start();
require_once('../Config/Conectar.php');

// Verificar si hay una consulta enviada
if (isset($_GET['query'])) {
    // Obtener la consulta y escapar caracteres peligrosos
    $consulta = htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8');

    // Preparar la consulta con parámetros
    $stmt = Conectar::conexion()->prepare("SELECT * FROM productos WHERE nombre LIKE :consulta");

    $consulta_param = "%" . $consulta . "%";
    $stmt->bindParam(':consulta', $consulta_param, PDO::PARAM_STR);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) {
            header("Location:error.php");
        } else {
            foreach ($result as $row) {
                echo "<img src='../imagenes/Productos/" . $row["Cod_producto"] . ".png' class='img-fluid'>";
                echo "<p>Código de producto: " . $row['Cod_producto'] . "</p>";
                echo "<p>Nombre de producto: " . $row['Nombre'] . "</p>";
                echo "<p>Precio de producto: $" . $row['Precio'] . "</p>";
            }
        }
    } else {
        echo "Error al ejecutar la consulta.";
    }
} else {
    echo "No se encontraron resultados.";
}


?>