<?php
include('../Config/Conectar.php');
session_start();

if (isset($_SESSION['correo'])) {
    $email = $_SESSION['correo'];
    $stmt = Conectar::conexion()->prepare("SELECT usuarios.nombre, usuarios.apellidos, usuarios.correo, usuarios.fecha_nacimiento, usuarios.fecha_registro,usuarios.Telefono ,roles.descripcion 
                                        FROM usuarios
                                        LEFT JOIN roles ON usuarios.id_rol = roles.id_rol
                                        WHERE correo='$email'");
    $stmt->execute();
    $valores = $stmt->fetch();
    $nombre = $valores['nombre'];
    $apellidos = $valores['apellidos'];
    $correo = $valores['correo'];
    $rol = $valores['descripcion'];
    $fecha_nacimiento = $valores['fecha_nacimiento'];
    $fecha_registro = $valores['fecha_registro'];

    /**
     *  ACTUALIZA EL USUARIO CON EL QUE SE INTRODUCE EN EL INPUT
     */
    if (isset($_POST['nombre']) && isset($_POST['apellidos'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $stmt = Conectar::conexion()->prepare("UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos' WHERE correo = '$correo'");
        $stmt->execute();
    }
    /**
     *  AÑADE EL TELEFONO
     */
    if (isset($_POST['telefono'])) {
        $telefono = $_POST['telefono'];
        $stmt = Conectar::conexion()->prepare("UPDATE usuarios SET telefono = '$telefono' WHERE correo = '$correo'");
        $stmt->execute();

    }
} else {
    echo "Por favor, inicia sesión";
    header("Location:../index.php");
}
?>

<body>
    <div class="d-flex align-items-center" style="height: 100vh;">
        <div style="margin: 0 auto;">
            <h1 class="text-center">Edita tu perfil</h1>
            <form action="" method="post">
                <div class="form-group text-center">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group text-center">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                        value="<?php echo $apellidos; ?>">
                </div>
                <div class="form-group text-center">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" class="form-control" readonly id="correo" name="correo"
                        value="<?php echo $correo; ?>">
                </div>
                <div class="form-group text-center">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" value="<?php if (!empty($valores['Telefono'])) {
                        echo $valores['Telefono'];
                    } else {
                        echo $valores['Telefono'];
                    } ?>" name="telefono">
                </div>
                <div class="form-group text-center">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="text" class="form-control" readonly id="fecha_nacimiento" name="fecha_nacimiento"
                        value="<?php echo $fecha_nacimiento; ?>">
                </div>
                <div class="form-group text-center">
                    <label for="fecha_registro">Fecha de registro:</label>
                    <input type="text" class="form-control" readonly id="fecha_registro" name="fecha_registro"
                        value="<?php echo $fecha_registro; ?>">
                </div>
                <div class="form-group text-center">
                    <label for="rol">Rol:</label>
                    <input type="text" class="form-control" readonly id="rol" name="rol" value="<?php echo $rol; ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Guardar cambios"
                    onclick="alert('Perfil actualizado correctamente'),location.reload()">
            </form>
        </div>
    </div>
</body>

</html>