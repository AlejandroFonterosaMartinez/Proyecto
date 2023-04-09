<?php
namespace View;

?>
<style>
    .profile-img-container {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
    }

    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<script>
    function clickImagen() {
        document.querySelector('#input-imagen').click();
    }

    function previewImagen() {
        const imagen = document.querySelector('#imagen-perfil');
        const file = document.querySelector('#input-imagen').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            imagen.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        } else {
            imagen.src = '../imagenes/imagen_mas.png';
        }
    }
</script>

<head>
    <meta charset="utf-8">
    <title>Editar perfil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php

if (isset($_POST['guardar'])) {
    // Obtener la ubicación temporal del archivo subido
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $id_usuario = $_SESSION['usuario'];
    // Verificar si se subió una imagen
    if ($imagen_temp) {
        // Obtener el nombre del archivo
        $imagen_nombre = $id_usuario . '.jpg';
        // Mover el archivo a la carpeta deseada en el servidor
        $destino = '../imagenes/Usuarios/' . $imagen_nombre;
        if (move_uploaded_file($imagen_temp, $destino)) {
            // Actualizar la variable $imagen con la nueva ubicación en el servidor
            $imagen = $destino;
        }
    }

    echo "<div class='alert alert-info alerta' style='text-align:center' role='alert'>Perfil actualizado correctamente</div>";
}

// Verificar si el usuario ya tiene una imagen y mostrarla
$id_usuario = $_SESSION['usuario'];
$imagen_ruta = '../imagenes/Usuarios/' . $id_usuario . '.jpg';
if (file_exists($imagen_ruta)) {
    $imagen = $imagen_ruta;
}
?>
<head>
    <meta charset="utf-8">
    <title>Editar perfil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Edita tu perfil</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-start mb-3">
                    <div class="position-relative">
                        <div onclick="clickImagen()" style="cursor: pointer;">
                            <img src="<?php echo $imagen ? $imagen : '../imagenes/imagen_mas.png'; ?>" width="100"
                                height="100" class="rounded-circle" id="imagen-perfil">
                        </div>
                        <input type="file" class="position-absolute w-100 h-100" style="opacity: 0; cursor: pointer;"
                            name="imagen" id="input-imagen" onchange="previewImagen()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                        value="<?php echo $apellidos; ?>">
                </div>
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" class="form-control" readonly id="correo" name="correo"
                        value="<?php echo $correo; ?>">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono"
                        value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : (isset($valores['telefono']) ? $valores['telefono'] : 'Introduzca TLF'); ?>"
                        name="telefono">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                        value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : (isset($valores['direccion']) ? $valores['direccion'] : ''); ?>">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="text" class="form-control" readonly id="fecha_nacimiento" name="fecha_nacimiento"
                        value="<?php echo $fecha_nacimiento; ?>">
                </div>
                <div class="form-group">
                    <label for="fecha_registro">Fecha de registro:</label>
                    <input type="text" class="form-control" readonly id="fecha_registro" name="fecha_registro"
                        value="<?php echo $fecha_registro; ?>">
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <input type="text" class="form-control" readonly id="rol" name="rol" value="<?php echo $rol; ?>">
                </div>
                <div class="form-group text-center">
                    <a href="../index.php" class="btn btn-secondary">Volver</a>
                    <input type="submit" class="btn btn-primary" name="guardar" value="Guardar cambios">
                </div>
            </form>
        </div>
    </div>

</div>


<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi4jq7f"
    crossorigin="anonymous"></script>