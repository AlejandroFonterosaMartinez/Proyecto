<?php
namespace Models;


use Config\Conectar;

class Productos_modelo
{
    private $productos;
    private $categorias;
    public function __construct()
    {
        $this->productos = array();
        $this->categorias = array();
    }
    /**
    *@brief Obtiene todos los productos de la base de datos.
    *@return array Un array con todos las productos obtenidas.
    
    */
    public function get_productos()
    {
        include 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php';
        $con = Conectar::conexion('busuario');
        $consulta = $con->query("SELECT * FROM productos WHERE destacado=1");
        while ($row = $consulta->fetch(\PDO::FETCH_ASSOC)) {
            $this->productos[] = $row;
        }
        return $this->productos;
    }


    /**
     * @brief Obtiene los productos de la base de dato.
     *
     * @param string $cod El codigo del producto que se quiere obtener.
     *
     * @return \PDOStatement|false Devuelve un objeto \PDOStatement que contiene los productos o false si ocurre un error.
     */
    public static function cargar_producto($cod)
    {
        include '../Config' . DIRECTORY_SEPARATOR . 'Conectar.php';

        $db = Conectar::conexion('busuario');
        $ins = "SELECT * FROM productos WHERE Cod_producto='$cod' AND Habilitado=1";
        $resul = $db->query($ins);
        return $resul;
    }
    /**
     * @brief inserta un pedido en la base de datos y devuelve el código del pedido insertado.
     *
     * @param   array  $carrito  Carrito de compras con los productos a insertar.
     * @param   int  $usuario    Id del usuario que realiza el pedido.
     *
     * @return   int|false          El código del pedido insertado o FALSE si no se ha podido insertar.
     */
    public static function insertar_pedido($carrito, $usuario)
    {

        $bd = Conectar::conexion('busuario');
        $bd->beginTransaction();
        try {
            $hora = date("Y-m-d");
            // insertar el pedido
            $sql1 = "insert into pedidos(fecha,usuario) 
			values('$hora',$usuario)";
            $bd->query($sql1);

            // coger el id del nuevo pedido para las filas detalle
            $pedido = $bd->lastInsertId();
            // insertar las filas en pedidoproductos
            foreach ($carrito as $codProd => $unidades) {
                $stmt = $bd->query("Select stock, nombre from productos where Cod_producto=$codProd");
                list($stock, $nombreproducto) = $stmt->fetch();
                if ($stock < $unidades) {
                    throw new \PDOException($nombreproducto . "<div class='alert-error alert'> No se ha podido realizar el producto.</div>");
                }
                $sql4 = "UPDATE productos set stock=? where Cod_producto=?";
                $stmt = $bd->prepare($sql4);
                $stock -= $unidades;
                $stmt->execute(array($stock, $codProd));

                $sql2 = "insert into pedidosproductos(Cod_pedido, Cod_producto, Unidades) 
		             values( ?, ?, ?)";
                $stmt = $bd->prepare($sql2);
                $stmt->execute(array($pedido, $codProd, $unidades));
            }
            $bd->commit();
            unset($stmt);
            return $pedido; //devuelve el código del nuevo pedido
        } catch (\PDOException $e) {
            echo $e->getMessage();
            $bd->rollback();
            return FALSE;
        } finally {
            unset($bd);
        }
    }
    /**
     * 
     * @brief Inserta productos en el carrito de compras
     *
     * @param array $codigosProductos Array con los códigos de productos a insertar
     *
     * @return mixed Retorna FALSE si no encuentra resultados, o un array con los productos encontrados.
     *
     */
    public static function insertar_carrito($codigosProductos)
    {
        $bd = Conectar::conexion('busuario');
        $placeholders = implode(',', array_fill(0, count($codigosProductos), '?'));
        $stmt = $bd->prepare("SELECT * FROM productos WHERE Cod_producto IN ($placeholders)");

        // bind the parameters
        $stmt->execute($codigosProductos);
        $resul = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!$resul) {
            return FALSE;
        }

        return $resul;
    }

    /**
    *@brief Obtiene todas las categorias de la base de datos.
    *@return array Un array con todas las categorias obtenidas.
    
    *@throws \Exception Si ocurre algún error durante la consulta.
    */
    public function get_categorias()
    {
        try {
            $con = Conectar::conexion('busuario');
            $consulta = $con->query("SELECT * FROM categorias");
            while ($row = $consulta->fetch(\PDO::FETCH_ASSOC)) {
                $this->categorias[] = $row;
            }
            return $this->categorias;
        } catch (\Exception $e) {
            die("Error: " . $e->getMessage());
        }

    }

    /**
     * @brief Obtiene los productos de una categoría específica.
     *
     * @param string $cat La categoría de la que se quieren obtener los productos.
     *
     * @return \PDOStatement|false Un objeto \PDOStatement que contiene los productos o false si ocurre un error.
     */
    public static function cargar_categorias($cat)
    {
        include('..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
        $db = Conectar::conexion('busuario');
        $ins = "SELECT Cod_producto,Nombre,Precio,Stock,Categoria FROM productos WHERE Categoria='$cat'AND Habilitado=1";
        $resul = $db->query($ins);
        return $resul;
    }


    public function calcularTotalPedidosMes($mes, $ango)
    {
        include('../..' . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Conectar.php');
        $db = Conectar::conexion('busuario');
        // Calcular total de pedidos en un mes y año determinados
        $query = "SELECT SUM(p.Precio * pp.Unidades) AS Total
                  FROM pedidosproductos pp
                  INNER JOIN productos p ON pp.Cod_producto = p.Cod_producto
                  INNER JOIN pedidos pe ON pp.Cod_pedido = pe.Cod_pedido
                  WHERE MONTH(pe.Fecha) = :mes AND YEAR(pe.Fecha) = :ango";
        try {
            $statement = $db->prepare($query);
            $statement->bindParam(':mes', $mes, \PDO::PARAM_INT);
            $statement->bindParam(':ango', $ango, \PDO::PARAM_INT);
            $statement->execute();
            $total = $statement->fetchColumn();
            // Si el total es null, establecerlo como 0
            $total = $total ? $total : 0;

            return number_format($total, 2) . "€";
        } catch (\PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }

    }

    public function calcularTotalPedidosAnio($anio)
    {

        $db = Conectar::conexion('busuario');
        // Calcular total de pedidos en un año determinado
        $query = "SELECT SUM(p.Precio * pp.Unidades) AS Total
                  FROM pedidosproductos pp
                  INNER JOIN productos p ON pp.Cod_producto = p.Cod_producto
                  INNER JOIN pedidos pe ON pp.Cod_pedido = pe.Cod_pedido
                  WHERE YEAR(pe.Fecha) = :anio";
        try {
            $statement = $db->prepare($query);
            $statement->bindParam(':anio', $anio, \PDO::PARAM_INT);
            $statement->execute();
            $total = $statement->fetchColumn();
            // Si el total es null, establecerlo como 0
            $total = $total ? $total : 0;

            return number_format($total, 2) . "€";
        } catch (\PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }

    }
    public function crearGraficaBarras($labels, $data, $chartId)
    {
        $grafica = '<canvas id="' . $chartId . '"></canvas>';
        $grafica .= '<script>
                        var ctx = document.getElementById("' . $chartId . '").getContext("2d");
                        var myChart = new Chart(ctx, {
                            type: "bar",
                            data: {
                                labels: ' . json_encode($labels) . ',
                                datasets: [{
                                    label: "Ganancias Anuales",
                                    data: ' . json_encode($data) . ',
                                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                                    borderColor: "rgba(75, 192, 192, 1)",
                                    borderWidth: 3
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>';

        return $grafica;
    }

    public function generarGraficaGananciasAnuales($ango)
    {
        $con = Conectar::conexion('busuario');

        // Calcular las ganancias mensuales del año especificado
        $query = "SELECT MONTH(pe.Fecha) AS Mes, SUM(p.Precio * pp.Unidades) AS Ganancias
                  FROM pedidosproductos pp
                  INNER JOIN productos p ON pp.Cod_producto = p.Cod_producto
                  INNER JOIN pedidos pe ON pp.Cod_pedido = pe.Cod_pedido
                  WHERE YEAR(pe.Fecha) = 2023
                  GROUP BY MONTH(pe.Fecha)";

        try {
            $statement = $con->prepare($query); 
            $statement->execute();
            $resultados = $statement->fetchAll(\PDO::FETCH_ASSOC);

            // Crear los datos para la gráfica
            $labels = [];
            $data = [];

            foreach ($resultados as $resultado) {
                $mes = $resultado['Mes'];
                $ganancias = $resultado['Ganancias'];

                $labels[] = date("F", mktime(0, 0, 0, $mes, 1)); // Obtener el nombre del mes
                $data[] = $ganancias;
            }

            // Cerrar la conexión
            $con = null;

            // Generar la gráfica de barras
            $chartId = 'ganancias-anuales- 2023';
            $grafica = $this->crearGraficaBarras($labels, $data, $chartId);

            // Devolver la gráfica generada
            return $grafica;
        } catch (\PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }



}