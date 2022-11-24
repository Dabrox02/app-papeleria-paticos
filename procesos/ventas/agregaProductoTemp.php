<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    require_once "../../clases/Conexion.php";
    require_once "../../clases/Ventas.php";

    $c = new conectar();
    $conexion = $c->conexion();

    $obj= new Ventas();

    $idcli = $_POST['idcliente']; // ID CLIENTE
    $idproduc = $_POST['productoVenta']; // ID PRODUCTO
    $descripcion = $_POST['descripcionProd']; // DESCRIPCION PRODUCTO
    $cantidad = $_POST['cantidadCompra']; // CANTIDAD COMPRADA
    $precio = $_POST['precioProd']; // PRECIO DEL PRODUCTO

    $sql = "SELECT nom_cli, ape_cli FROM clientes WHERE id_cliente = '$idcli'";
    $result = mysqli_query($conexion, $sql);
    $cliente = mysqli_fetch_row($result);
    $nom_cli = $cliente[0]." ".$cliente[1]; // NOMBRE CLIENTE

    $sql = "SELECT nom_producto FROM productos WHERE id_producto = '$idproduc'";
    $result = mysqli_query($conexion, $sql);
    $nom_prod = mysqli_fetch_row($result)[0]; // NOMBRE PRODUCTO

    $producto = $idproduc."||".     // 0 
                $nom_prod."||".     // 1
                $descripcion."||".  // 2
                $precio."||".       // 3
                $cantidad."||".     // 4
                $nom_cli."||".      // 5
                $idcli;             // 6

    $_SESSION['tablaComprasTemp'][]=$producto;
    echo $idcli;
?>