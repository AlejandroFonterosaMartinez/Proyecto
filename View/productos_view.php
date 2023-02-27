<div class="contenedor_productos">
  <div class="owl-carousel owl-theme">
    <?php
    foreach ($array_productos as $row) {
      $precio_formateado = number_format($row["Precio"], 2);
      echo "<div class='producto'>
          <img src='imagenes/Productos/{$row['Cod_producto']}.png'></img>
          <label>{$row['Nombre']}</label>
          <label>{$precio_formateado}€/Ud.</label>
          <form method='post'>
          <div class='button'>
          <input type='hidden' name='id_producto_fav' value='{$row['Cod_producto']}'>
            <button class='favButton' name='anadir_fav' type='submit'>❤</button>
            </form>
            <form method='post' action='agregar_favoritos.php'>
              <input type='hidden' name='id_producto' value='{$row['Cod_producto']}'>
              <input type='hidden' name='cantidad' value='1'>
              <button class='trollButton' name='anadir' type='submit'>AÑADIR AL CARRITO</button>
            </form>
          </div>
        </div>";
    }
    ?>
  </div>
</div>