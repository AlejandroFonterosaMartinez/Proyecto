<?php
class UserRegistration extends Conectar
{
    public function register($nombre, $apellidos, $fecha_nacimiento, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $id_rol = date("Y-m-d H:i:s");
        $id_rol = 1;
        $trn_data =  date("Y-m-d");
        $check_email = "SELECT * FROM usuarios WHERE Correo=:email";

        $stmt = $this->conexion()->prepare($check_email);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $check_email = $stmt->rowCount();

        if ($check_email > 0) {
            echo "<p style='color:red'>El correo ya está en uso, intente con otro.</p>";
        } else {
            $query = "INSERT INTO usuarios (Nombre, Apellidos, Fecha_Nacimiento, Correo, Contraseña, Fecha_Registro,id_rol) 
                      VALUES (:nombre, :apellidos, :fecha_nacimiento, :email, :password, :trn_date,:id_rol)";

            $stmt = $this->conexion()->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);+
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':trn_date', $trn_data);
            $stmt->bindParam(':id_rol', $id_rol);

            if ($stmt->execute()) {
                echo "<p style='color:green';margin: 8px 0;>Registro completado!</p>";
                echo "<div style='margin: 8px 0;color: green;'>Cargando...</div>";
                echo "<script>setTimeout(function(){ window.location.href = '../index.php'; }, 1000);</script>";
            } else {
                echo "<p style='color:red'>Ha ocurrido un error al intentar registrarse. Por favor, inténtelo de nuevo más tarde.</p>";
            }
        }
    }
}