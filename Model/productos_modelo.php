<?php

class Productos_model
{

    private $db;
    private $productos;

    /**
     * __construct Implementa la conexion con la bd, y asigna un array a productos
     *
     */
    public function __construct()
    {
        require_once "Config/Conectar.php";
        $this->db = Conectar::conexion();
        $this->productos = array();
    }

    /**
     * get_productos realiza una consulta en la base de datos en la que destados = 1 para mostrar los productos destacados y los va devolviendo en un array 
     *
     * @return  [array] return array de productos
     */
    public function get_productos()
    {

        $consulta = $this->db->query("SELECT * FROM productos where destacado = 1");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->productos[] = $row;
        }
        return $this->productos;
    }
}

function cargar_categorias($cat)
{
    include('../Config/Conectar.php');
    /*
 * Devuelve un puntero con el código y nombre de las categorías de la BBDD
 * o falso si se produjo un error
 */

    $db = Conectar::conexion();
    $ins = "SELECT Cod_producto,Nombre,Precio FROM productos WHERE Categoria='$cat'";
    $resul = $db->query($ins);
    return $resul;
}
