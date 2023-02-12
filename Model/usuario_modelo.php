<?php

class User extends Conectar
{
    public function getUser($email, $password)
    {
        $stmt = $this->conexion()->prepare("SELECT usuarios.Correo, usuarios.Contraseña, usuarios.id_rol FROM `usuarios` WHERE Correo='$email'");
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['Contraseña'])) {
                return $user;
            }
            return false;
        }
        return false;
    }
}

?>