
<?php

$con = mysqli_connect("localhost", "root", "", "construccion");
// Check connection
if (mysqli_connect_errno()) {
    echo "Error en la conexión a MySQL: " . mysqli_connect_error();
}


?>