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
        require_once "Config" . DIRECTORY_SEPARATOR . "Conectar.php";
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

        $consulta = $this->db->query("SELECT * FROM productos WHERE destacado=1");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $this->productos[] = $row;
        }
        return $this->productos;
    }

}
function cargar_categorias($cat)
{
    include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
    /*
     * Devuelve un puntero con el código y nombre de las categorías de la BBDD
     * o falso si se produjo un error
     */

    $db = Conectar::conexion();
    $ins = "SELECT Cod_producto,Nombre,Precio FROM productos WHERE Categoria='$cat'";
    $resul = $db->query($ins);
    return $resul;
}

function insertar_pedido($carrito, $iduser)
{
    $bd = Conectar::conexion();
    $bd->beginTransaction();
    try {
        $factura = random_num();
        $fecha = date("Y-m-d");
        // insertar el pedido
        $sql1 = "insert into pedidos(Cod_pedido, fecha) 
			values( $factura, '$fecha')";
        $bd->query($sql1);
        // coger el id del nuevo pedido para las filas detalle
        $pedido = $bd->lastInsertId();
        // insertar las filas en pedidoproductos
        foreach ($carrito as $codProd => $unidades) {
            $stmt = $bd->prepare("Select stock, nombre from productos where Cod_producto=?");
            $stmt->execute(array($codProd));
            list($stock, $nombreproducto) = $stmt->fetch();
            if ($stock < $unidades) {
                throw new PDOException("El producto $nombreproducto no dispone del stock solicitado");
            }
            $stock -= $unidades;
            $stmt = $bd->prepare("UPDATE productos set stock=? where Cod_producto=?");
            $stmt->execute(array($stock, $codProd));

            $stmt = $bd->prepare("insert into pedidosproductos(Cod_pedido, Cod_producto, Unidades) 
		             values(?, ?, ?)");
            $stmt->execute(array($pedido, $codProd, $unidades));
        }
        $bd->commit();
        return $pedido;
    } catch (PDOException $e) {
        echo $e->getMessage();
        $bd->rollback();
        return FALSE;
    } finally {
        unset($bd);
    }
}
/**
 * [random_num funcion que genera un numero aleatorio de 3 cifras]
 *
 * @return  [type]  [return $key numero aleatorio]
 */
function random_num()
{
    $length = 2 ;
    $key = '';
    $keys = array_merge(range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}