<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    
    require_once "../../clases/Conexion.php";
    require_once "../../clases/Categorias.php";

    $id = $_POST['idCategoria'];

    $obj = new categorias();
    echo $obj->eliminaCategoria($id)

?>