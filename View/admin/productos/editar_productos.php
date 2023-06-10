<!doctype html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <title>PHP Function in JavaScript Demo</title>
    <style>
        body {
            font-family: 'Lato';
            font-weight: 400;
            font-size: 1.4rem;
        }

        p {
            text-align: center;
            margin-bottom: 4rem;
        }

        #textarea {
            width: 100%;
            resize: none;
            overflow: hidden;
            min-height: 50px;
            max-height: 100px;
            line-height: 20px;
            font-size: 14px;
            padding: 10px;
            box-sizing: border-box;
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="añadir">
        <H1>Agregar Productos</H1>
        <div id="botones" class="btn-group"><a href="../admin.php"><button style="margin-right:5px;" class="btn btn-secondary">
                    Volver</button></a>
            <form method="post" enctype="multipart/form-data">
                <button type='submit' id="añadir" name="añadir" class='btn btn-outline-success'>Añadir</button>
        </div>
        <div class="tabla">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Descripcion_detallada</th>
                        <th scope="col">Destacado</th>
                    </tr>
                </thead>
                <tbody class="agregar">
                    <td>

                        <input type="file" name="image" id="image"/>

                    </td>
                    </form>
                    </form>
                    <td><textarea id='textarea' cols='15' rows='10' class='texta'
                            placeholder="Nombre producto"></textarea></td>
                    <td><textarea id='textarea' cols='20' rows='10' class='texta'
                            placeholder="Descripcion corta"></textarea></td>
                    <td><textarea id='textarea' cols='5' rows='10' class='texta' placeholder="Precio sin €"></textarea>
                    </td>
                    <td><textarea id='textarea' cols='5' rows='10' class='texta'
                            placeholder="Cantidad productos"></textarea></td>
                    <td><textarea id='textarea' cols='5' rows='10' class='texta'
                            placeholder="Del 0 al 10 o el nombre"></textarea></td>
                    <td><textarea id='textarea' cols='30' rows='10' class='texta'
                            placeholder="Descripción larga"></textarea></td>
                    <td><textarea id='textarea' cols='5' rows='10' class='texta' placeholder="Si o No"></textarea>
                    </td>
                </tbody>
            </table>
        </div>

    </div>

    <div class="editar">
        <h1>Editar Productos</h1>
        <div id="botones">
            <button type='button' id="cargar" name="cargar" class='btn btn-primary'>Cargar</button>
            <select name="categorias" id="categorias">
                <option value="*">Categorias</option>
                <?php require('cat.php'); ?>
            </select>
        </div>


        <div class="tabla">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Cod_producto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Descripcion_detallada</th>
                        <th scope="col">Destacado</th>

                    </tr>
                </thead>
                <tbody class="pruebas">
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var editando = 0;
        var cargado = 0;
        var pruebas = document.getElementsByClassName('pruebas');
        var añadir = document.getElementsByClassName('agregar');
        var cargarbtn = document.getElementById('cargar');
        var añadirbtn = document.getElementById('añadir');
        cargarbtn.addEventListener('click', function (e) {
            e.preventDefault();
            cargar();
        });
        añadirbtn.addEventListener('click', function (e) {
            e.preventDefault();
            //agregar();
            crearImg();
        });

        var select = document.getElementById('categorias').addEventListener ('change', function (e) {
            cargado_selectivo(e.target.value);
        });    
            

        function agregar() {
            //console.log("La función guardar() se está ejecutando desde: ");
            //console.log(new Error().stack);

            var textAreas = document.querySelectorAll('.texta');
            //console.log(textAreas[0].value);
            //var textarea = document.querySelectorAll(".texta");
            //textarea.forEach(area => console.log(area.value));

            var formData = new FormData();
            formData.append('nombre', textAreas[0].value);
            formData.append('descripcion', textAreas[1].value);
            formData.append('precio', textAreas[2].value);
            formData.append('stock', textAreas[3].value);
            formData.append('categoria', textAreas[4].value);
            formData.append('descripcionD', textAreas[5].value);
            formData.append('destacado', textAreas[6].value);

            $.ajax({
                data: {
                    "nombre": textAreas[0].value,
                    "descripcion": textAreas[1].value,
                    "precio": textAreas[2].value,
                    "stock": textAreas[3].value,
                    "categoria": textAreas[4].value,
                    "descripcionD": textAreas[5].value,
                    "destacado": textAreas[6].value
                },
                method: "POST",
                url: "productos_crear.php"
            })
                .done(function (response) {
                    crearImg();
                    cargar();
                });
        }

        function agregar() {
            //console.log("La función guardar() se está ejecutando desde: ");
            //console.log(new Error().stack);

            var textAreas = document.querySelectorAll('.texta');
            //console.log(textAreas[0].value);
            //var textarea = document.querySelectorAll(".texta");
            //textarea.forEach(area => console.log(area.value));

            $.ajax({
                data: {
                    "nombre": textAreas[0].value,
                    "descripcion": textAreas[1].value,
                    "precio": textAreas[2].value,
                    "stock": textAreas[3].value,
                    "categoria": textAreas[4].value,
                    "descripcionD": textAreas[5].value,
                    "destacado": textAreas[6].value
                },
                method: "POST",
                url: "productos_crear.php"
            })
                .done(function (response) {
                    cargar();
                });
        }

        function guardar(fila) {
            //console.log("La función guardar() se está ejecutando desde: ");
            //console.log(new Error().stack);

            var elementos = fila.parentNode.children;
            var textarea = document.querySelectorAll(".texta2");
            textarea.forEach(area => console.log("valor" + area.value));
            $.ajax({
                data: {
                    "cod": elementos[0].innerHTML,
                    "nombre": textarea[0].value,
                    "descripcion": textarea[1].value,
                    "precio": textarea[2].value,
                    "stock": textarea[3].value,
                    "categoria": textarea[4].value,
                    "descripcionD": textarea[5].value,
                    "destacado": textarea[6].value
                },
                method: "POST",
                url: "productos_guardar.php"
            })
                .done(function (response) {
                    //console.log(response);
                    cargar();
                });
            editando--;
        }



        function mostrar(fila) {
            if (editando == 0) {
                editando++;
                var elementos = fila.parentNode.children;
                for (let i = 1; i < 8; i++) {
                    var datos = elementos[i].innerHTML;
                    console.log(elementos[i].innerHTML);
                    elementos[i].innerHTML = "<textarea  id='textarea' cols='30' rows='10' class='texta2'>" + elementos[i].innerHTML + "</textarea>"
                    const textarea = document.getElementById("textarea");

                    textarea.addEventListener("input", function () {
                        this.style.height = "auto";
                        this.style.height = (this.scrollHeight) + "px";
                    });
                }
                elementos[8].innerHTML = "<button type='button' id='btn' class='btn btn-success'>Guardar</button>";
                elementos[9].innerHTML = "<button type='button' id='btn' class='btn btn-warning'>Cancelar</button>";
            } else {
                console.log('ya se esta editando un elemento');
            }
            const btnWarning = document.querySelectorAll(".btn-warning");
            btnWarning.forEach(editBtn => editBtn.addEventListener("click", function (e) {
                e.preventDefault;
                cargar();
                editando--;
                //Fmostrar(editBtn.parentNode);
            })

            );
            const btnSucess = document.querySelectorAll(".btn-success");
            btnSucess.forEach(editBtn => editBtn.addEventListener("click", function (e) {
                e.preventDefault;
                console.log('dentro de boton guardar');
                guardar(editBtn.parentNode);
            })

            );

        }

        function cargado_selectivo(categoria) {
            cargado++;
            $.ajax({
                data:{
                    "categoria" : categoria
                },
                method: "POST",
                url: "productos_categoria.php"
            })
                .done(function (response) {
                    $("tbody.pruebas").html(response);
                    const botonesEditar = document.querySelectorAll(".btn-info");
                    botonesEditar.forEach(editBtn => editBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        console.log('dentro de boton');
                        mostrar(editBtn.parentNode);
                    })

                    );
                    const botonesBorrar = document.querySelectorAll(".btn-danger");
                    botonesBorrar.forEach(deletBtn => deletBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        console.log('dentro de boton');
                        borrar(deletBtn.parentNode);
                    })

                    );
                    cargarbtn.innerHTML = "Actualizar";
                });
            console.log('ya esta cargado');
        }

        function cargar() {
            cargado++;
            $.ajax({
                method: "POST",
                url: "productos_cargar.php"
            })
                .done(function (response) {
                    $("tbody.pruebas").html(response);
                    const botonesEditar = document.querySelectorAll(".btn-info");
                    botonesEditar.forEach(editBtn => editBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        console.log('dentro de boton');
                        mostrar(editBtn.parentNode);
                    })

                    );
                    const botonesBorrar = document.querySelectorAll(".btn-danger");
                    botonesBorrar.forEach(deletBtn => deletBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        console.log('dentro de boton');
                        borrar(deletBtn.parentNode);
                    })

                    );
                    cargarbtn.innerHTML = "Actualizar";
                });
            console.log('ya esta cargado');
        }

        function categoria() {
            cargado++;
            $.ajax({
                method: "POST",
                url: "productos_categoria.php"
            })
                .done(function (response) {
                    $("tbody.pruebas").html(response);
                    const botonesEditar = document.querySelectorAll(".btn-info");
                    botonesEditar.forEach(editBtn => editBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        console.log('dentro de boton');
                        mostrar(editBtn.parentNode);
                    })

                    );
                    const botonesBorrar = document.querySelectorAll(".btn-danger");
                    botonesBorrar.forEach(deletBtn => deletBtn.addEventListener("click", function (e) {
                        e.preventDefault();
                        console.log('dentro de boton');
                        borrar(deletBtn.parentNode);
                    })

                    );
                    cargarbtn.innerHTML = "Actualizar";
                });
            console.log('ya esta cargado');
        }


        function borrar(fila) {
            var elementos = fila.parentNode.children;
            $.ajax({
                data: {
                    "cod": elementos[0].innerHTML
                },
                method: "POST",
                url: "productos_borrar.php"
            })
                .done(function (response) {
                    cargar();
                });

        }

        function crearImg() {

            var formData = new FormData();
            var files = document.getElementById('image').files[0];
            formData.append('file', files);



            $.ajax({
                data: formData,
                method: "POST",
                url: "subir_imagen.php",
                contentType: false,
                processData: false
            })
                .done(function (response) {
                });
        }
        

    </script>
</body>

</html>

</html>