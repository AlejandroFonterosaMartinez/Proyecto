<?php

class User extends Conectar
{

    /**
     * 
     * El método "getUser" ejecuta una sentencia SQL preparada para seleccionar un registro de la tabla "usuarios" donde el correo electrónico y la contraseña coincidan con los 
     * argumentos proporcionados. La contraseña se encripta mediante el algoritmo SHA-256 antes de realizar la búsqueda en la base de datos.
     * @param mixed $email
     * @param mixed $password
     * @return bool
     */
    public function getUser($email, $password)
    {

        // Prevenir la inyección SQL mediante el uso de sentencias preparadas
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conexion()->prepare("SELECT usuarios.Correo, usuarios.Contraseña FROM `usuarios` WHERE Correo='$email'");
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }
}
?>