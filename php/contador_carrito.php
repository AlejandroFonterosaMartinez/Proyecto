<?php
 
 if(isset($_SESSION['cart'])){
    $count = count($_SESSION['cart']);
    echo"<div class='contador'>" . $count . "</div>";
 
 } else {
    echo"<div class='contador'>0</div>";
 }

 ?>