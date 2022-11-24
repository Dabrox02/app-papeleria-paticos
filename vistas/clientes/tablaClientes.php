<?php
require_once "../../clases/Conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();
$sql = "SELECT id_cliente,
                nom_cli,
                ape_cli,
                direccion,
                email_cli,
                tel_cli 
            FROM clientes";
$result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <tr>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Direccion</td>
        <td>Email</td>
        <td>Telefono</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </tr>

    <?php
    while ($ver = mysqli_fetch_row($result)) :
    ?>
        <tr>
            <td><?php echo $ver[1];?></td>
            <td><?php echo $ver[2];?></td>
            <td><?php echo $ver[3];?></td>
            <td><?php echo $ver[4];?></td>
            <td><?php echo $ver[5];?></td>
            <td>
                <span class="btn btn-warning btn-sm" type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#modalClientesAct"
                onclick="agregaDatosCliente('<?php echo $ver[0]; ?>')">
                    <i class="bi bi-pencil-fill"></i>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-sm" type="button"
                onclick="eliminarCliente('<?php echo $ver[0]; ?>')">
                    <i class="bi bi-trash3-fill"></i>
                </span>
            </td>
        </tr>
    <?php
    endwhile;
    ?>
</table>