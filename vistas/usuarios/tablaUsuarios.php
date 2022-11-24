<?php

    require_once "../../clases/Conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();

    $sql = "SELECT id_usuario, nom_user, ape_user, email_user FROM usuarios WHERE id_usuario != 1;";
    $result = mysqli_query($conexion, $sql);
?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <tr>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Usuario</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </tr>

    <?php
        while ($ver = mysqli_fetch_row($result)) :
    ?>

    <tr>
        <td><?php echo $ver[1]; ?></td>
        <td><?php echo $ver[2]; ?></td>
        <td><?php echo $ver[3]; ?></td>
        <td>
            <span class="btn btn-warning btn-sm" type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#actualizaUsuarioModel" 
                onclick="agregaDatosUser('<?php echo $ver[0];?>')">
                <i class="bi bi-pencil-fill"></i>
            </span>
        </td>
        <td>
            <span class="btn btn-danger btn-sm" type="button" 
            onclick="eliminaUsuario('<?php echo $ver[0]; ?>')">
                <i class="bi bi-trash3-fill"></i>
            </span>
        </td>
    </tr>

    <?php
        endwhile;
    ?>

</table>