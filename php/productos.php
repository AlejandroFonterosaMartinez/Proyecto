<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div>
        <input type="button" class="categoria" value="Tejados Y Cubiertas" />
        <input type="button" class="categoria" value="Arenas y Gravas" />
        <input type="button" class="categoria" value="Cementos Y Morteros" />
        <input type="button" class="categoria" value="Madera" />
        <input type="button" class="categoria" value="Hormigoneras, carretillas..." />
        <input type="button" class="categoria" value="Cercados y Ocultación" />
        <input type="button" class="categoria" value="Yesos Y Escayolas" />
        <input type="button" class="categoria" value="Elementos de construcción" />
        <input type="button" class="categoria" value="Aislamientos" />

        <div class="mostrar">
            <?php
            include('../Model/productos_modelo.php');
            $productos = cargar_categorias($_GET['categoria']);

            foreach ($productos as $producto) {

                $cod = $producto['Cod_producto'];
                $nom = $producto['Nombre'];
                $pre = $producto['Precio'];
                /*
             * Dentro del formulario hay un campo oculto para enviar el código del producto
             * que debemos añadir al carro del la compra. El formulario llama al fichero anadir.php
             */
                echo "<ul><li>$cod</li><li>$nom</li><li>$pre</li></ul>";
            }

            ?>
        </div>
        <script>
            const editButtons = document.querySelectorAll(".categoria");
            editButtons.forEach(editBtn => editBtn.addEventListener("click", () => select_productos(editBtn.value)));

            function select_productos(value) {
                console.log(value);
                $.ajax({
                        data: {
                            "categoria": value
                        },
                        method: "POST",
                        url: "select_productos.php"
                    })
                    .done(function(response) {
                        console.log(response);
                        $("div.mostrar").html(response);
                        //document.getElementsByClassName('botoncito').addEventListener('click',mostrar);
                        //const editButtons = document.querySelectorAll(".btn-info");
                        //editButtons.forEach(editBtn => editBtn.addEventListener("click", () => mostrar(editBtn.parentNode)));

                    });
            }
        </script>
    </div>

</body>

</html>