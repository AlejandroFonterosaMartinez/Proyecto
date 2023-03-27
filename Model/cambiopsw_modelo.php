<?php

namespace Models;

use Config\Conectar;

include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
class CambiarPasswordModelo
{

    public static function cambiarPassword($token, $nueva_password, $confirmar_password)
    {

        // Obtener la conexión a la base de datos
        $con = Conectar::conexion('busuario');

        // Obtener la contraseña actual del usuario
        $sql = "SELECT Contraseña FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":id_usuario", $token);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $contraseña_actual = $row['Contraseña'];

        if ($nueva_password == $confirmar_password) {
            // Verificar si la contraseña actual es diferente de la nueva contraseña
            if (password_verify($nueva_password, $contraseña_actual)) {
                return "La nueva contraseña no puede ser la misma que la contraseña actual";
            }

            // Actualizar la contraseña del usuario
            $hashed_password = password_hash($nueva_password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET Contraseña = :pass WHERE id_usuario = :id_usuario";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":pass", $hashed_password);
            $stmt->bindParam(":id_usuario", $token);
            $stmt->execute();

            return "Contraseña cambiada con éxito";
        } else {
            // Las contraseñas no coinciden
            return "Las contraseñas no coinciden";
        }
    }
    public static function obtener_token_por_correo($email)
    {
        $con = Conectar::conexion('busuario');

        // Preparar la consulta SQL utilizando marcadores de posición
        $sql = "SELECT id_usuario FROM usuarios WHERE Correo = :email";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Obtener el resultado de la consulta
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario con el correo electrónico proporcionado
        if ($row) {
            $token = $row['id_usuario'];
            return $token;
        } else {
            return false;
        }
    }

}