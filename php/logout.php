<?php
session_start();
session_destroy();
setcookie("Usuario", "", time() - 3600, "/");
setcookie("Administrador", "", time() - 3600, "/");
header("Location: ../index.php");
exit();
?>