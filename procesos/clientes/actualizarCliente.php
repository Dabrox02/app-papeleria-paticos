<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once "../../clases/Conexion.php";
require_once "../../clases/Clientes.php";

$obj = new clientes();

$datos = array(
    $_POST['idcliente'],
    $_POST['nombreCliAct'],
    $_POST['apellidoCliAct'],
    $_POST['direccionCliAct'],
    $_POST['emailCliAct'],
    $_POST['telCliAct']
);

echo $obj->actualizarCliente($datos);