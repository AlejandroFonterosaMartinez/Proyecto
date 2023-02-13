<?php
// Iniciar sesión
session_start();

// Clase para el carrito de compras
class Cart
{
    public $items;

    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $this->items = $_SESSION['cart'];
    }

    public function addItem($product)
    {
        array_push($this->items, $product);
        $_SESSION['cart'] = $this->items;
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $_SESSION['cart'] = $this->items;
    }
}

// Crear una instancia del carrito de compras
$cart = new Cart();

// Agregar un producto al carrito de compras
if (isset($_GET['add'])) {
    $cart->addItem($_GET['add']);
}

// Eliminar un producto del carrito de compras
if (isset($_GET['remove'])) {
    $cart->removeItem($_GET['remove']);
}

// Mostrar el contenido del carrito de compras
echo "<h2>Contenido del carrito de compras</h2>";
echo "<ul>";
foreach ($cart->items as $index => $product) {
    echo "<li>" . $product . " <a href='?remove=" . $index . "'>Eliminar</a></li>";
}
echo "</ul>";

// Mostrar un enlace para agregar productos al carrito de compras
echo "<a href='?add=producto1'>Agregar producto 1</a><br>";
echo "<a href='?add=producto2'>Agregar producto 2</a><br>";
echo "<a href='?add=producto3'>Agregar producto 3</a><br>";