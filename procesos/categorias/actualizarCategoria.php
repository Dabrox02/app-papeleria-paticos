<?php
    require_once "../../clases/Conexion.php";
    require_once "../../clases/Categorias.php";

    $datos = array(
        $_POST['idCategoria'],
        $_POST['categoriaAct']
    );
    $obj= new categorias();

    echo $obj->actualizaCategoria($datos);

?>