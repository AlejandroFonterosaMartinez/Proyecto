<?php
include_once('../Config/Conectar.php');

class PerfilModel
{
    public static function getPerfil($email)
    {
        $stmt = Conectar::conexion()->prepare("SELECT usuarios.nombre, usuarios.apellidos, usuarios.correo, usuarios.fecha_nacimiento, usuarios.fecha_registro,usuarios.Telefono ,roles.descripcion 
                                        FROM usuarios
                                        LEFT JOIN roles ON usuarios.id_rol = roles.id_rol
                                        WHERE correo='$email'");
        $stmt->execute();
        $valores = $stmt->fetch();
        return $valores;
    }

    public static function updateNombreApellido($email, $nombre, $apellidos)
    {
        $stmt = Conectar::conexion()->prepare("UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos' WHERE correo = '$email'");
        $stmt->execute();
    }

    public static function updateTelefono($email, $telefono)
    {
        $stmt = Conectar::conexion()->prepare("UPDATE usuarios SET telefono = '$telefono' WHERE correo = '$email'");
        $stmt->execute();
    }
}   