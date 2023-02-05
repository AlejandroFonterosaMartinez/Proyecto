<?php
class Conectar
{

    public static function conexion()
    {
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=construccion;charset=utf8", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
        return $conexion;
    }

}
?>