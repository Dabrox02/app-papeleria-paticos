<?php

require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();

$datos = array(
    $_POST['idUsuarioAct'],
    $_POST['nombreAct'],
    $_POST['apellidoAct'],
    $_POST['usuarioAct']
);

echo $obj->actualizarUsuario($datos);

?>