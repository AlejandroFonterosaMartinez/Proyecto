<?php
include('sesion.php');
session_destroy();
setcookie("Usuario", "", time() - 3600, "/");
setcookie("Administrador", "", time() - 3600, "/");
header("Location: ../index.php");
exit();
?>