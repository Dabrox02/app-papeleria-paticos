<?php

if (!isset($_SESSION)) {
    session_start();
}
$iduser = $_SESSION['iduser'];
require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj = new articulos();

$datos = array();

$nombreImg = $_FILES['imagenArt']['name'];
$rutaAlmacenamiento = $_FILES['imagenArt']['tmp_name'];
$carpeta = "../../archivos/";
$rutaFinal = $carpeta.$nombreImg;

$datosImg = array(
    $_POST['categoriaSelect'],
    $nombreImg,
    $rutaFinal
);

if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
    $idimagen = $obj->agregaImagen($datosImg);

    if($idimagen > 0){

        $datos[0] = $_POST['categoriaSelect'];
        $datos[1] = $idimagen;
        $datos[2] = $iduser;
        $datos[3] = $_POST['nombreArt'];
        $datos[4] = $_POST['descripcionArt'];
        $datos[5] = $_POST['cantidadArt'];
        $datos[6] = $_POST['precioArt'];
        echo $obj->insertaArticulo($datos);
    } else {
        echo 0;
    }
}
