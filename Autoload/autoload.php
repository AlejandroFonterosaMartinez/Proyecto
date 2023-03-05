<?php
function mi_autoload($clase)
{
    include_once $clase . '.php';
}

spl_autoload_register('mi_autoload');

?>