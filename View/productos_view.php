<div class="contenedor_productos">
    <div class="owl-carousel owl-theme">
        <?php
        foreach ($array_productos as $row) {
            echo "<div class='producto'>";
            echo "<img src='imagenes/Productos/" . $row["Cod_producto"] . ".png'</img>";
            echo '<label>' . $row["Nombre"] . '</label>';
            echo '<label>' . $row["Precio"] . '€/Ud.' . '</label>';
            echo '<button class="favButton" type="submit">AÑADIR A FAVORITOS</button>';
            echo '<form method="post" name="producto_carrito" action="view/carrito_view.php"><button class="trollButton" type="submit">AÑADIR AL CARRITO</button></form>';
            echo '</div>';
        }
        ?>
    </div>
</div>