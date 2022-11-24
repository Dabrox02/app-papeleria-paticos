<?php

    require_once "../../clases/Conexion.php";
    require_once "../../clases/Articulos.php";

$obj = new articulos();

$datos = array(
    $_POST['idArticulo'],
    $_POST['categoriaSelectAct'],
    $_POST['nombreArtAct'],
    $_POST['descripcionArtAct'],
    $_POST['cantidadArtAct'],
    $_POST['precioArtAct']
);

echo $obj->actualizarProducto($datos);
