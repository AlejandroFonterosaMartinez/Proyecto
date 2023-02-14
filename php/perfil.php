<?php
include('../Config/Conectar.php');
session_start();

if (isset($_SESSION['correo'])) {
    $email = $_SESSION['correo'];
    $stmt = Conectar::conexion()->prepare("SELECT usuarios.nombre, usuarios.apellidos, usuarios.correo, usuarios.fecha_nacimiento, usuarios.fecha_registro, roles.descripcion 
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

<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <title>BricoTeis SL</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>BricoTeis SL</title>
    <link href="../css/header.css" rel="stylesheet" type="text/css">
    <link href="../css/index.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="icon" href="../imagenes/Logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<header>
        <div class="container">

            <div class="infoPag">
                <a href="../index.php">
                    <img src="../imagenes/Header/Logo.svg" />
                    BricoTeis SL
                </a>
            </div>

            <div class="buscador">
                <form action="search.php" method="get">
                    <div class="cajaTexto">
                        <form action="search.php" method="get">
                            <div class="cajaTexto">
                                <input type="text" name="query" name="query" placeholder="Buscar...">
                                <button type="submit">Buscar</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>

            <div class="menuPers">
                <?php if (!isset($_SESSION['correo'])) {
                    echo '
                     <div class="cuenta"><img src="../imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                             <div class="subdiv"><a href="../php/registro.php"><img src="../imagenes/Header/01Menu/edit.svg" />Registrarse</a>
                             </div>
                             <div class="subdiv"><a href="../php/login.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Iniciar Sesión</div></a>
                         </div>
                     </div>
                     <div><a href="#"><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
                     <div><a href="#"><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a></div>
                 </div>';
                } else {
                    echo '<div class="cuenta"><a href="#"></a><img src="../imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                        <div class="subdiv"><a href="../php/perfil.php"><img src="../imagenes/Header/01Menu/edit.svg" />Editar Perfil</a>
                        </div>
                        <div class="subdiv"><a href="../php/logout.php"><img src="../imagenes/Header/01Menu/entrance.svg" />Cerrar Sesión ';

                    echo '</div></a>
                    </div>
                </div>
                <div><a href="#"></a><img src="../imagenes/Header/01Menu/heart.svg" />Favoritos</div>
                <div><a href="#"></a><img src="../imagenes/Header/01Menu/shopping-cart.svg" />Carrito</div>'
                    ;

                } ?>

            </div>
    </header>
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
                    <input type="text" class="form-control" placeholder="Añade tu número de teléfono" id="telefono"
                        value="<?php if (isset($telefono)) {
                            echo $telefono;
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
                    onclick="alert('Perfil actualizado correctamente')">
            </form>
        </div>
    </div>
</body>

</html>