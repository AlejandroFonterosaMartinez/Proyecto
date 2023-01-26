<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/register.css" />
</head>

<body>
    <div class="form">
        <h1>Registro</h1>
        <form name="registro" action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" id="username" name="username" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" placeholder="Nombre" />
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" required placeholder="Apellidos" />
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required value="<?php echo isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : ''; ?>" placeholder="Fecha Nacimiento" />
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email" />
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Contraseña" />
            <input type="submit" name="submit" value="Registrarse" />
        </form>
        <?php
        /**
         * Implementamos la clase db.php que contiene la conexión con la base de datos
         */
        require('db.php');
        session_start();
        /**
         * Validadores/checkeadores/eliminador de caracteres para las entradas obtenidas
         */
        if (isset($_REQUEST['username'])) {
            $nombre = stripslashes($_REQUEST['username']);
            $nombre = mysqli_real_escape_string($con, $nombre);
            $apellidos = stripslashes($_REQUEST['apellidos']);
            $apellidos = mysqli_real_escape_string($con, $apellidos);
            $fecha_nacimiento = stripslashes($_REQUEST['fecha_nacimiento']);
            $fecha_nacimiento = mysqli_real_escape_string($con, $fecha_nacimiento);
            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con, $email);
            $password = password_hash(stripslashes($_REQUEST['password']), PASSWORD_DEFAULT);
            $trn_date = date("Y-m-d H:i:s");
            $check_email = "SELECT * FROM usuarios WHERE Correo='$email'";
            $run_email = mysqli_query($con, $check_email);
            $check_email = mysqli_num_rows($run_email);

            /**
             * Comprobación del correo mediante una subconsulta, para probar que no se repita 
             */
            if ($check_email == 1) {
                echo "<p style='color:red'>El correo ya esta en uso, intente con otro.</p>";
            } else {
                /**
                 * En caso de no repetirse ir insertando los valores en la base de datos y redirigir al index.php
                 */
                $query = "INSERT into `usuarios` (Nombre, Apellidos, Fecha_Nacimiento, Correo, Contraseña, Fecha_Registro) VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$email', '$password', '$trn_date')";
                $result = mysqli_query($con, $query);
                if ($result) {
                    // CODIGO DEL CORREO DE CONFIRMACIÓN <AQUI>

                    echo "<p style='color:green'>Registro Completado!</p>";
                    echo "<div class='loading'>Cargando...</div>";
                    echo "<script>setTimeout(function(){ window.location.href = '../index.php'; }, 1000);</script>";
                }
            }
        }
        ?>
</body>

</html>