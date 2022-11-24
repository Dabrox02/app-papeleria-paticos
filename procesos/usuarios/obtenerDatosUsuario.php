<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj = new usuarios();
$iduser = $_POST['idusuario'];

echo json_encode($obj->obtenDatosUsuarios($iduser));

?>