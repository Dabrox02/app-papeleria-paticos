<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/Clientes.php";

$obj = new clientes();
$idcli = $_POST['idcliente'];

echo $obj->eliminarCliente($idcli);

?>