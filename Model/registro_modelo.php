<?php
class UserRegistration extends Conectar
{
    public function register($nombre, $apellidos, $fecha_nacimiento, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $id_rol = date("Y-m-d H:i:s");
        $id_rol = 1;
        $trn_data = date("Y-m-d");
        $check_email = "SELECT * FROM usuarios WHERE Correo=:email";

        $stmt = $this->conexion()->prepare($check_email);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $check_email = $stmt->rowCount();

        if ($check_email > 0) {
            echo '<div class="alert alert-danger" role="alert" style="text-align:center;">El correo ya está en uso, intente con otro.</div>';
        } else {
            $edad = $this->calcularEdad($fecha_nacimiento);
            if ($edad < 16 || $edad > 100) {
                echo '<div class="alert alert-danger" role="alert" style="text-align:center;"> La edad debe ser mayor o igual a 16 años y menor o igual a 100 años.</div>';
                return;
            }

            $query = "INSERT INTO usuarios (Nombre, Apellidos, Fecha_Nacimiento, Correo, Contraseña, Fecha_Registro,id_rol) 
                      VALUES (:nombre, :apellidos, :fecha_nacimiento, :email, :password, :trn_date,:id_rol)";

            $stmt = $this->conexion()->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            +
                $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':trn_date', $trn_data);
            $stmt->bindParam(':id_rol', $id_rol);

            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert" style="text-align:center;">Registro completado!</div>';
                echo "<script>setTimeout(function(){ window.location.href = '../index.php'; }, 1000);</script>";
            } else {

                echo '<div class="alert alert-danger" role="alert" style="text-align:center;">Ha ocurrido un error al intentar registrarse. Por favor, inténtelo de nuevo más tarde.</div>';
            }
        }
    }
    function calcularEdad($fecha_nacimiento)
    {
        $fecha_actual = date("Y-m-d");
        $edad = floor((strtotime($fecha_actual) - strtotime($fecha_nacimiento)) / (60 * 60 * 24 * 365.25));
        return $edad;
    }
}