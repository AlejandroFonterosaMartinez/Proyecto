<?php

class Productos_model
{

    private $db;
    private $productos;

    public function __construct()
    {
        require_once "Config/Conectar.php";
        $this->db = Conectar::conexion();
        $this->productos = array();
    }

    public function get_productos()
    {

        $consulta = $this->db->query("SELECT * FROM productos where Destacado = 1");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->productos[] = $row;
        }
        return $this->productos;
    }

}