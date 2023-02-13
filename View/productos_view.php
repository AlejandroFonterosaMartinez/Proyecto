<div class="contenedor_productos">
    <div class="owl-carousel owl-theme">
        <?php
        foreach ($array_productos as $row) {
            echo "<div class='producto'>";
            echo "<img src='imagenes/Productos/" . $row["Cod_producto"] . ".png'</img>";
            echo '<label>' . $row["Nombre"] . '</label>';
            echo '<label>' . $row["Precio"] . '€/Ud.' . '</label>';
            echo '<div class="button">';
            echo '<button class="favButton" type="submit">❤</button>';
            echo '<form method="post">';
            echo '<input type="hidden" name="id_producto" value="' . $row["Cod_producto"] . '">';
            echo '<button class="trollButton" name="anadir" type="submit">AÑADIR AL CARRITO</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>