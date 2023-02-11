<?php

class User extends Conectar
{

    public function getUser($email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conexion()->prepare("SELECT usuarios.Correo, usuarios.Contraseña, usuarios.id_rol FROM `usuarios` WHERE Correo='$email'");
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
}
?>