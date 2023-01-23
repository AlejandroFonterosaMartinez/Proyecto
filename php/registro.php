<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <?php
        require('db.php');

        if (isset($_REQUEST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);
            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $trn_date = date("Y-m-d H:i:s"); // GUARDA LA HORA EN LA QUE SE REALIZA EL REGISTRO
            $query = "INSERT into `usuarios` (Usuario, Contraseña, Correo, Fecha_Registro)
            VALUES ('$username', '" . $password . "', '$email', '$trn_date')";

            $result = mysqli_query($con, $query);
            if ($result) {

                header("Location: principal.php");
                echo "<script>alert('Registro Completado!');</script>";
            }
        } else {
            ?>
            <div class="form">
                <h1>Registro</h1>
                <form name="registro" action="" method="post">
                    <input type="text" name="username" placeholder="Usuario" required />
                    <input type="email" name="email" placeholder="Correo" required />
                    <input type="password" name="password" placeholder="Contraseña" required />
                    <input type="submit" name="submit" value="Registrarse" />
                </form>
            </div>
        <?php } ?>
    </body>
</html>