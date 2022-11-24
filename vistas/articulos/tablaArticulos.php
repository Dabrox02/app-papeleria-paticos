<?php

    require_once "../../clases/Conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();
    $sql = "SELECT art.nom_producto, art.descripcion,  art.cantidad, art.precio, img.ruta, cat.nombre_categoria, art.id_producto
            FROM productos AS art
            INNER JOIN imagenes as img ON art.id_imagen = img.id_imagen
            INNER JOIN categorias as cat ON art.id_categoria = cat.id_categoria";

    $result = mysqli_query($conexion, $sql);

?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <tr>
        <td>Nombre</td>
        <td>Descripcion</td>
        <td>Cantidad</td>
        <td>Precio</td>
        <td>Imagen</td>
        <td>Categoria</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </tr>
    <?php 
        while($ver = mysqli_fetch_row($result)):
    ?>
    <tr>
        <td><?php echo $ver[0];?></td>
        <td><?php echo $ver[1];?></td>
        <td><?php echo $ver[2];?></td>
        <td><?php echo $ver[3];?></td>
        <td>
            <?php 
            $imgVer = explode("/",$ver[4]);
            $imgRuta = $imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
            ?>
            <img src="<?php echo $imgRuta;?>" width="90px" height="90px">
        </td>
        <td><?php echo $ver[5];?></td>
        <td>
            <span data-bs-toggle="modal" data-bs-target="#modalActualizar" class="btn btn-warning btn-sm" type="button" 
                onclick="agregaDatosArticulo('<?php echo $ver[6] ?>')">
                <i class="bi bi-pencil-fill"></i>
            </span>
        </td>
        <td>
            <span class="btn btn-danger btn-sm" type="button" 
            onclick="eliminaProducto('<?php echo $ver[6] ?>')">
                <i class="bi bi-trash3-fill"></i>
            </span>
        </td>
    </tr>

    <?php endwhile;?>

</table>