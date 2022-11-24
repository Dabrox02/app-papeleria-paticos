<?php

    require_once "../../clases/Conexion.php";
    $c = new conectar();
    $conexion = $c->conexion();

    $sql = "SELECT id_categoria, nombre_categoria FROM categorias;";
    $result = mysqli_query($conexion, $sql);

?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
        <tr>
            <td>Categoria</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>

        <?php
        while ($ver = mysqli_fetch_row($result)) :
        ?>

            <tr>
                <td>
                    <?php
                    echo $ver[1]
                    ?>
                </td>
                <td>
                    <span class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#actualizaCategoria" type="button" 
                    onclick="agregaDato('<?php echo $ver[0]?>','<?php echo $ver[1]?>')">
                        <i class="bi bi-pencil-fill"></i>
                    </span>
                </td>
                <td>
                    <span class="btn btn-danger btn-sm" type="button" 
                    onclick="eliminaCategoria('<?php echo $ver[0]?>')">
                        <i class="bi bi-trash3-fill"></i>
                    </span>
                </td>
            </tr>

        <?php
        endwhile;
        ?>

    </table>
</div>