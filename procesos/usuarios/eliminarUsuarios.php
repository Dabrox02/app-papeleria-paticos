<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();
$iduser = $_POST['idusuario'];

echo $obj->eliminarUsuario($iduser);

?>