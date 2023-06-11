<?php
// Obtener los pedidos de la base de datos
use Config\Conectar;

include(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "Conectar.php");

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link href="../../../css/calendario.css" rel="stylesheet" type="text/css">
    <!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/esm/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Agregamos nuestros estilos personalizados -->
    <style>
    .pedido-info2 {
        display: none;
    }

    .pedido-info2.visible {
        display: block;
    }
    h1{
            text-align: center;
            animation: 1s ease-out 0s 1 slideInFromLeft;
        }
        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(0);
            }
        }
</style>


</head>


<?php
try {
    $pdo = Conectar::conexion('BTadmin');
    $pdo = Conectar::conexion('BTadmin');
} catch (PDOException $e) {
    echo 'Error al conectarse a la base de datos: ' . $e->getMessage();
    exit;
}
$sql = "SELECT pedidos.Cod_pedido,usuarios.Nombre,Fecha FROM pedidos INNER JOIN usuarios ON pedidos.Usuario = usuarios.id_usuario";
$statement = $pdo->prepare($sql);
$statement->execute();
$pedidos = $statement->fetchAll(PDO::FETCH_ASSOC);

// Crear un arreglo de eventos
$eventos = array();
foreach ($pedidos as $pedido) {
    $fecha = $pedido['Fecha'];
    $numero_pedido = $pedido['Cod_pedido'];
    $nombre_cliente = $pedido['Nombre'];
    $eventos[$fecha][] = array('numero_pedido' => $numero_pedido, 'nombre_cliente' => $nombre_cliente);
}
// Obtener el mes y año actual
$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
// Generar el calendario
echo '<div class="row">';
echo '<div class="col-12">';
echo '<div class="module">';
echo '<div class="module-header d-flex justify-content-between align-items-center">';
echo '<h1>Calendario de pedidos - ' . $month . '/' . $year . '</h1><br><br><br>';
echo '</div>';
echo '<div class="module-body">';
echo '<table class="calendar-table">';
echo '<tr>';
echo '<th class="calendar-header">Domingo</th>';
echo '<th class="calendar-header">Lunes</th>';
echo '<th class="calendar-header">Martes</th>';
echo '<th class="calendar-header">Miércoles</th>';
echo '<th class="calendar-header">Jueves</th>';
echo '<th class="calendar-header">Viernes</th>';
echo '<th class="calendar-header">Sábado</th>';
echo '</tr>';
// Botón para el mes anterior
$prev_month = ($month == 1) ? 12 : $month - 1;
$prev_year = ($month == 1) ? $year - 1 : $year;
echo '<button id="prevMonthBtn" class="butone" onclick="location.href=\'?month=' . $prev_month . '&year=' . $prev_year . '\'">Mes Anterior</button>';
echo '<button id="prevMonthBtn" class="butone" onclick="location.href=\'?month=' . $prev_month . '&year=' . $prev_year . '\'">Mes Anterior</button>';
// Botón para el mes siguiente
$next_month = ($month == 12) ? 1 : $month + 1;
$next_year = ($month == 12) ? $year + 1 : $year;
echo '<button id="nextMonthBtn" class="butone" onclick="location.href=\'?month=' . $next_month . '&year=' . $next_year . '\'">Mes Siguiente</button><br><br><br>';
echo '<button id="nextMonthBtn" class="butone" onclick="location.href=\'?month=' . $next_month . '&year=' . $next_year . '\'">Mes Siguiente</button><br><br><br>';
$fecha_actual = strtotime("$year-$month-01");
$ultimo_dia_del_mes = strtotime('last day of this month', $fecha_actual);
$dia_actual = 1;
while ($fecha_actual <= $ultimo_dia_del_mes) {
    echo '<tr>';
    for ($i = 0; $i < 7; $i++) {
        $fecha_actual_str = date('Y-m-d', $fecha_actual);
        $tiene_pedido = isset($eventos[$fecha_actual_str]);
        $clase = $tiene_pedido ? 'has-pedidos' : 'no-pedidos';
        echo '<td data-date="' . $fecha_actual_str . '" class="calendar-cell ' . $clase . '">';

        echo '<td data-date="' . $fecha_actual_str . '" class="calendar-cell ' . $clase . '">';

        if ($tiene_pedido) {
            echo '<div class="pedido-info2">';
            echo '<div class="pedido-info2">';
            foreach ($eventos[$fecha_actual_str] as $evento) {
                echo '<div class="pedido-info-item2">';
                echo '<form method="POST" action="detalles_pedido.php">';
                echo '<input type="hidden" name="numero_pedido" value="' . $evento['numero_pedido'] . '">';
                echo '<input type="hidden" name="nombre_cliente" value="' . $evento['nombre_cliente'] . '">';
                echo '<div class="pedido-info-item2">';
                echo '<form method="POST" action="detalles_pedido.php">';
                echo '<input type="hidden" name="numero_pedido" value="' . $evento['numero_pedido'] . '">';
                echo '<input type="hidden" name="nombre_cliente" value="' . $evento['nombre_cliente'] . '">';
                echo '<span class="cliente">Cliente: ' . $evento['nombre_cliente'] . '</span><br>';
                echo '<span class="pedido">Pedido: ' . $evento['numero_pedido'] . '</span><br>';
                echo '<button type="submit" value=""  style="height:15%;"class="butone">Ver detalles</button>';
                echo '</form>';
                echo '<span class="pedido">Pedido: ' . $evento['numero_pedido'] . '</span><br>';
                echo '<button type="submit" value=""  style="height:15%;"class="butone">Ver detalles</button>';
                echo '</form>';
                echo '</div>';
            }
            
            
            echo '</div>';
        }

        echo '</td>';
        $fecha_actual = strtotime('+1 day', $fecha_actual);
        $dia_actual++;
    }
    echo '</tr>';
}

echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '<a href="../admin.php"><button class="btn btn-secondary">Volver</button></a>';
echo '<a href="../admin.php"><button class="btn btn-secondary">Volver</button></a>';
?>
<script>
    const cells = document.querySelectorAll(".calendar-cell");
    cells.forEach(cell => {
        cell.addEventListener("click", () => {
            const pedidos = cell.querySelector(".pedido-info2");
            const pedidos = cell.querySelector(".pedido-info2");
            if (pedidos) {
                pedidos.classList.toggle("visible");
                pedidos.classList.toggle("visible");
                const backdrop = document.createElement("div");
                backdrop.classList.add("backdrop");
                document.body.appendChild(backdrop);
                backdrop.addEventListener("click", () => {
                    pedidos.classList.remove("visible");
                    document.body.removeChild(backdrop);
                })
            }
        })
    })
</script>