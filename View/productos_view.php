<div class="contenedor_productos">
    <div class="owl-carousel owl-theme">
        <?php
        foreach ($array_productos as $row) {
            echo "<div class='producto'> <form action='../php/c.php' method='post'>  ";
            echo "<img src='imagenes/Productos/" . $row["Cod_producto"] . ".png'</img>";
            echo '<label>' . $row["Precio"] . '€/Ud.' . '</label> ';
            echo '<label>' . $row["Nombre"] . '</label>';
            echo '<button type="submit">Añadir al carrito</button>';
            echo '</form></div>';
        }
        ?>
    </div>
</div>