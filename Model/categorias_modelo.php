<?php
namespace Models;

use Config\Conectar;

class Categorias_modelo
{
    private $db;
    private $categorias;

    /**
     * [__construct Implementa la conexion con la bd, y asigna un array a categorias]
     *
     */
    public function __construct()
    {
        require_once(".." . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "Conectar.php");
        $this->db = Conectar::conexion();
        $this->categorias = array();
    }
    /**
     * [get_categorias realiza una consulta en la base de datos en la tabla de categorias los va devolviendo en un array ]
     *
     * @return  [array]  [return array de categorias]
     */
    public function get_categorias()
    {
        try {
            $consulta = Conectar::conexion()->query("SELECT * FROM categorias");
            while ($row = $consulta->fetch(\PDO::FETCH_ASSOC)) {
                $this->categorias[] = $row;
            }
            return $this->categorias;
        } catch (\Exception $e) {
            die("Error: " . $e->getMessage());
        }

    }
    /**
     * [cargar_categorias description]
     *
     * @param   [type]  $cat  [$cat description]
     *
     * @return  [type]        [return description]
     */
    public function cargar_categorias($cat)
    {
        include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
        /*
         * Devuelve un puntero con el código y nombre de las categorías de la BBDD
         * o falso si se produjo un error
         */

        $db = Conectar::conexion();
        $ins = "SELECT Cod_producto,Nombre,Precio,Stock FROM productos WHERE Categoria='$cat'";
        $resul = $db->query($ins);
        return $resul;
    }
}


?>