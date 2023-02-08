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
            echo '<label>' . $row["Nombre"] . '</label>';
            echo "<img src='imagenes/Productos/" . $row["Cod_producto"] . ".png' border='0' width='150' height='100'</img>";
            echo '<label>' . $row["Precio"]."€/Ud.". '</label>';

        }
        return $this->productos;
    }

}