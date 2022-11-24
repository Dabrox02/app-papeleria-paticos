<?php 

if (!isset($_SESSION)) {
    session_start();
}

require_once "../../clases/Conexion.php";
require_once "../../clases/Categorias.php";

if (isset($_SESSION['iduser'])) {
    $fecha = date("Y-m-d");
    $idusuario = $_SESSION['iduser'];
    $categoria = $_POST['categoria'];

    $datos = array(
        $idusuario,
        $categoria,
        $fecha
    );

    $categor = new categorias();

    echo $categor->agregaCategoria($datos);
}

?>