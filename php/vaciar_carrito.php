<?php
session_start();
unset($_SESSION['carrito']);
unset($_SESSION['cart_count']);
header("Location: carrito.php");

?>