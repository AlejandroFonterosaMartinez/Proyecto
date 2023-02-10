
    <div class="contenedor_productos">
            <?php
            foreach ($array_productos as $row) {
                echo "<div class='producto'>";
                echo "<img src='imagenes/Productos/" . $row["Cod_producto"] . ".png'</img>";
                echo '<label>' . $row["Precio"].'€/Ud.' . '</label>';
                echo '<label>' . $row["Nombre"] . '</label>';
                echo '<button type="submit">Añadir al carrito</button>';
                echo '</div>';
            }
            ?>
    </div>


