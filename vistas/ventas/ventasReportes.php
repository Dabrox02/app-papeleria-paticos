<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../../clases/Conexion.php";
require_once "../../clases/Ventas.php";

$c = new conectar();
$conexion = $c->conexion();
$obj = new ventas();

$sql = "SELECT id_venta, fechaCompra, id_cliente 
            FROM ventas GROUP BY id_venta";

$result = mysqli_query($conexion, $sql);

?>

<br>
<h4>Venta productos</h4>
<br>

<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="table-responsive">
            <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
                <tr>
                    <td>Id</td>
                    <td>Fecha</td>
                    <td>Cliente</td>
                    <td>Total de Compra</td>
                    <td>Reporte</td>
                </tr>
                
                <?php
                    while($ver = mysqli_fetch_row($result)):
                ?>

                <tr>
                    <td><?php echo $ver[0] ?></td>
                    <td><?php echo $ver[1] ?></td>
                    <td>
                        <?php 
                            if($obj->nombreCliente($ver[2]) == 0){
                                echo "S/C";
                            } else {
                                echo $obj->nombreCliente($ver[2]);
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            echo "$".$obj->obtenerTotal($ver[0]);
                        ?>
                    </td>
                    <td>
                        <a href="../procesos/ventas/crearReportePdf.php?idventa=<?php echo $ver[0];?>" class="btn btn-danger" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-flag-fill"></i>
                        </a>
                    </td>
                </tr>

                <?php
                    endwhile;
                ?>
            </table>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>
