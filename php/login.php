<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="../css/login.css" />

<body>
    <?php
    require('db.php');
    session_start();

    if (isset($_POST['username'])) {
        // Quita las slashes del usuario
        $username = stripslashes($_REQUEST['username']);
        //Convierte los caracteres especiales en un string special
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //Comprueba si el usuario existe en la base de datos
        $query = "SELECT usuarios.Correo, usuarios.Contraseña FROM `usuarios` WHERE Correo='$username'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $user = mysqli_fetch_assoc($result);
            $hash = $user['Contraseña'];
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                // Redirecciona al usuario a la página principal
                header("Location: ../index.php");
            } else {
                // Recarga la página con el usuario introducido y muestra un mensaje de error
                echo "<script> window.location.href = 'login.php?username=$username&error=1' </script>";
            }
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
                    placeholder="Correo" required />
                <input type="password" name="password" placeholder="Contraseña" required />
                <input name="submit" type="submit" value="Login" />
            </form>
            <p>Todavía sin una cuenta? <a href='registro.php'>Registrate aquí</a></p>
        </div>
    <?php } ?>
</body>

</html>