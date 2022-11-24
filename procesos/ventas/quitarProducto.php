<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once "../../clases/Conexion.php";
require_once "../../clases/Ventas.php";

$index = $_POST['ind'];

unset($_SESSION['tablaComprasTemp'][$index]);
$datos = array_values($_SESSION['tablaComprasTemp']);
unset($_SESSION['tablaComprasTemp']);
$_SESSION['tablaComprasTemp'] = $datos;

?>