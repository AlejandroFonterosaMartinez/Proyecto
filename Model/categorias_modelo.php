<?php

class Categorias_model
{

    private $db;
    private $categorias;

    public function __construct()
    {
        require_once("../Config/Conectar.php");
        $this->db = Conectar::conexion();
        $this->categorias = array();
    }

    public function get_categorias()
    {

        $consulta = $this->db->query("SELECT * FROM categorias");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->categorias[] = $row;
        }
        return $this->categorias;
    }


}


?>