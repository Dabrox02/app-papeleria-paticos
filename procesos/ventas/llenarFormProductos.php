<?php
    require_once "../../clases/Conexion.php";
    require_once "../../clases/Ventas.php";

    $obj= new Ventas();

    $idprod = $_POST['idproducto'];

    echo json_encode($obj->obtenerDatosProd($idprod));

?>