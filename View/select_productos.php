<?php
use Config\Conectar;

include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');


/*
 * Devuelve un puntero con el código y nombre de las categorías de la BBDD
 * o falso si se produjo un error
 */

$con = Conectar::conexion('busuario');
$cat = $_POST['categoria'];
$ins = "SELECT *
        FROM productos
        WHERE Categoria = (SELECT Cod_categoria FROM categorias WHERE Nombre = '$cat');";
$resul = $con->query($ins);
$texto = '';
$texto .= "<div class='titCat'>$cat</div>";
$texto .= "<div class='textCat'>Descubre nuestra amplia gama de $cat, diseñados para satisfacer las necesidades de cualquier proyecto de construcción.</div>";
$texto .= "<div class='productos'>";
foreach ($resul as $row) {
    $cod = $row['Cod_producto'];
    $stock = $row['Stock'];
    $precio_formateado = number_format($row["Precio"], 2);
    $texto .= "<div class='producto'>";
    $texto.= "<a href='producto.php?codigo=" . $row['Cod_producto'] . "'>";
    $texto .= "<img src='../imagenes/Productos/Categorias/{$row['Categoria']}/{$row['Cod_producto']}.png'></img></a>  ";
    $texto .= "<label>" . $row["Nombre"] . "</label>";
    $texto .= "<label>" . $precio_formateado . "€/Ud</label>";
    $texto .= "<div class='button'>
    <form class='fav' method='post'>
          <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>🤍</button>
            </form>
            <form class='troll' method='post'>
              <input type = 'submit' class='trollButton' name='anadir' value='Añadir al carrito'><input name ='cod' type='hidden' value = '$cod'></input>
              <input name = 'unidades' type='number' min = '1' max='{$row['Stock']}' value = '1'>
            </form>
    </div>";
    $texto .= "</div>";
}
$texto .= "</div>";
$output = $texto;
echo $output;