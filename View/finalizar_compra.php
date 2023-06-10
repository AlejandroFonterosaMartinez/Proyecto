<?php
use Config\Conectar;
use Models\Correo_modelo;
use Models\Productos_modelo;
use Models\Login_modelo;

include('sesion.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'login_modelo.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'productos_modelo.php');
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'correo_modelo.php');


?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Finalizar pedido</title>
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link href="../css/finalizar_compra.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<?php


// OBTENER NOMBRE DEL USUARIO
$nombre = Login_modelo::getNombreUsuario($_SESSION['correo']);
$cod_producto = $_SESSION['carrito'];
$resul = Productos_modelo::insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']);
$total = 0;
$con = Conectar::conexion('busuario');
$cons = $con->query("SELECT productos.Categoria, productos.cod_producto, productos.nombre, productos.precio, pedidosproductos.unidades 
FROM productos 
JOIN pedidosproductos ON productos.cod_producto = pedidosproductos.cod_producto 
WHERE pedidosproductos.cod_pedido = $resul");
$productos = $cons->fetchAll(\PDO::FETCH_ASSOC);
if ($cons === FALSE) {
    echo "<div  class='alert-warning alert' role='alert'> No se ha podido realizar el producto.</div>";
    header("LOCATION:" . $_SERVER['HTTP_REFERER']);
} else {
    $correo = $_SESSION['correo'];
    $cuerpo = "Gracias " . $nombre . " por realizar el pedido en BricoTeis. Sus productos: ";
    $total = 0;

    $cuerpo = '<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    </head> 
    <body style="font-family:Helvetica;" align="center"> 
    
        <div id="div_solic" align="left" style="max-width:900px;background-color:#f9f9f9;">
            <div align="left" style="display:block;max-width:900px;width:fit-content;background-color:#f9f9f9;padding-bottom:30px;">
                <table id="tablaFactura" style="margin-left:11px;max-width:900px;width:100%;border-bottom:2px solid #2F5496;background-color:#f9f9f9;" border="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Unidades</th>
                        </tr>
                    </thead>';

    foreach ($productos as $producto) {
        $categoria = $producto['Categoria'];
        $cod = $producto['cod_producto'];
        $nom = $producto['nombre'];
        $precio = $producto['precio'];
        $unidades = $producto['unidades'];
        $total += ($precio * $unidades);

        $cuerpo .= "<tr>
                    <td style='text-align: center;'>{$nom}</td>
                    <td style='text-align: center;color:green;'>{$precio} €</td>
                    <td style='text-align: center;color:blue;'>{$unidades}</td>
                </tr>
                ";

    }

    $cuerpo .= '<p STYLE="color:red;"> TOTAL: ' . $total . ' €</p></table>

    <footer style="text-align: center; font-size: 12px; color: #555;">
    <p>
      BricoTeis &copy; 2023 | Teléfono: +00 000 000| 
      <a href="mailto:bricoteis@b21.daw2d.iesteis.gal">bricoteis@b21.daw2d.iesteis.gal</a>
    </p>
  </footer>
  
    </body>
</html>';

    echo "<div class='alert-success alert' id='alert-suc' style='text-align:center' role='alert'> Pedido realizado con éxito. Se enviará un correo de confirmación a: <strong> $correo </strong> </div>";
    Correo_modelo::enviar_correo($correo, $nombre, "Pedido realizado.", $cuerpo);


    foreach ($productos as $producto) {
        $nom = $producto['nombre'];
        $precio = $producto['precio'];
        $unidades = $producto['unidades'];
        $total += ($precio * $unidades);
    }
    //Vacia el carrito pues o bien se hizo el pedido o bien hubo un error
    $_SESSION['carrito'] = [];
    $_SESSION['cart_count'] = count($_SESSION['carrito']);

    // Actualiza el valor de count_cart a 0 después de vaciar el carrito
    if ($_SESSION['cart_count'] === 0) {
        $_SESSION['cart_count'] = 0;
    }

}
//   IVA + ENVIO 
$total += ($total * 0.21) + 3;
?>
<!DOCTYPE html>
<html lang="es">


<body id="pagina-imprimir">

    <div class="container" id="descargar">


        <div class="header">
            <img src="../imagenes/Logo.ico" alt="Logo" class="logo">
            <div class="info">
                <button id="download-button" class="btn btn-light boton-imprimir">Descargar factura 💾</button>
                <p>BricoTeis SL</p>
                <p>CIF: B12345678</p>
                <p>Dirección: Teis, 12</p>
                <p>Teléfono: 777 666 777</p>
            </div>
        </div>
        <table>
            <tr>
                <th>Cliente: </th>
                <td>
                    <?php echo $nombre ?>
                </td>
            </tr>
            <tr>
                <th>Fecha: </th>
                <td>
                    <?php echo date("Y-m-d") ?>
                </td>
            </tr>
            </td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Precio unitario</th>
                <th class="text-center">Unidades</th>
                <th class="text-center">Total<div class='small'>Iva + envío incluido</div>

                </th>
            </tr>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td class="text-center">
                        <?php echo $producto['nombre']; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $producto['precio']; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $producto['unidades']; ?>
                    </td>
                    <td class="text-center">
                        <?php
                        echo $producto['precio'] * $producto['unidades'];
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"></td>
                <td class="text-center">
                    <strong>
                        <?php echo number_format($total, 2) . "€"; ?>
                    </strong>
                </td>
            </tr>
        </table>

        <div class="legal">
            <p>Este documento es una factura electrónica y tiene la misma validez legal que una factura en papel.
            </p>
            <p>Powered by BricoTeis SL</p>
            <div class="boton-imprimir">
                <a href="../index.php"><button class='btn-warning btn' id="volveratras">Volver</button></a>
            </div>
        </div>
        <br>
        <br>
    </div>

</body>

</html>


<script>
    const guardarpdf = document.getElementById('download-button');

    function generarpdf() {
    const element = document.getElementById('descargar');
    const fechaHoy = new Date().toISOString().slice(0, 10);
    const nombreArchivo = 'factura_' + fechaHoy + '.pdf';

    html2pdf().from(element).save(nombreArchivo);
    document.getElementById('download-button').style.visibility = 'hidden';
    
    // Almacenar el estado de visibilidad de los botones en el almacenamiento local
    localStorage.setItem('botonesVisibles', 'false');
}


    guardarpdf.addEventListener('click', generarpdf);

    // Obtener el elemento del div
    const alertSuc = document.getElementById('alert-suc');
    

    // Función para ocultar el div
    function ocultarDiv() {
        alertSuc.style.visibility = 'hidden';
    }
    // Programar el ocultamiento después de 5 segundos (5000 milisegundos)
    setTimeout(ocultarDiv, 5000);
</script>