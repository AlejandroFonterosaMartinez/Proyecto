<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="../css/login.css" /></head>

<body>
    <?php
    require('db.php');
    session_start();
    // Si se ha enviado el formulario, se comprueban las credenciales
    if (isset($_POST['username'])) {
        // Quita las slashes del usuario
        $username = stripslashes($_REQUEST['username']);
        //Convierte los caracteres especiales en un string special
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //Comprueba si el usuario existe en la base de datos
        $query = "SELECT usuarios.Usuario, usuarios.Contraseña FROM `usuarios` WHERE Usuario='$username'
    and Contraseña='" . $password . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirecciona al usuario a la página principal
            header("Location: ../index.php");
        } else {
            // Recarga la página con el usuario introducido y muestra un mensaje de error
            echo "<script> window.location.href = 'login.php?username=$username&error=1' </script>";
        }
    } else {
        ?>
        <div class="formulario">
            <h1>Logueate Aquí</h1>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p style="color:red">Usuario o contraseña incorrectos</p>';
            }
            ?>
            <form action="" method="post" name="login">
                <input type="text" name="username" value="<?php echo isset($_GET['username']) ? $_GET['username'] : '' ?>"
                    placeholder="Usuario" required />
                <input type="password" name="password" placeholder="Contraseña" required />
                <input name="submit" type="submit" value="Login" />
            </form>
            <p>Todavía sin una cuenta? <a href='registro.php'>Registrate aquí</a></p>
        </div>
    <?php } ?>
</body>

</html>