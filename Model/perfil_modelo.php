<?php
namespace Models;


use Config\Conectar;

class Perfil_modelo extends Conectar
{
    public function obtenerUsuario($email)
    {
        $con = Conectar::conexion('busuario');
        $stmt = $con->prepare("SELECT usuarios.nombre, usuarios.apellidos, usuarios.correo, usuarios.fecha_nacimiento, usuarios.fecha_registro, roles.descripcion
    FROM usuarios
    LEFT JOIN roles ON usuarios.id_rol = roles.id_rol
    WHERE correo='$email'");
        $stmt->execute();
        $valores = $stmt->fetch();
        return $valores;
    }
    /**
     * @brief Actualiza el nombre y apellidos de un usuario a partir de su correo electrónico
     * @param string $email Correo electrónico del usuario
     * @param string $nombre Nuevo nombre del usuario
     * @param string $apellidos Nuevos apellidos del usuario
     * @return void
     */
    public function actualizarNombre($email, $nombre, $apellidos)
    {
        $con = Conectar::conexion('busuario');
        $stmt = $con->prepare("UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos' WHERE correo = '$email'");
        $stmt->execute();
    }

}