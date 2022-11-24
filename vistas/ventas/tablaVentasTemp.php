<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "../../clases/Conexion.php";
require_once "../../clases/Ventas.php";

?>

<h4>Hacer venta</h4>
<h4>
    <Div id="nombreClienteVenta"></Div>
</h4>

<caption>
    <span class="btn btn-success" onclick="crearVenta()">
        <i class="bi bi-currency-dollar"> Hacer Venta</i>
    </span>
</caption>
<p></p>
<table class="table table-bordered table-hover table-condensed" style="text-align:center;">
    <tr>
        <td>Nombre</td>
        <td>Descripcion</td>
        <td>Precio</td>
        <td>Cantidad</td>
        <td>Quitar</td>
    </tr>
    <?php
        $total = 0;
        $cliente = "";
        if(isset($_SESSION['tablaComprasTemp'])):
            $index = 0;
            foreach(@$_SESSION['tablaComprasTemp'] as $key){
                
                $d = explode("||", @$key);
    ?>
    <tr>
        <td><?php echo $d[1]?></td>
        <td><?php echo $d[2]?></td>
        <td><?php echo $d[3]?></td>
        <td><?php echo $d[4]?></td>
        <td>
            <span class="btn btn-danger btn-sm" onclick="quitarProduc('<?php echo $index;?>')">
                <i class="bi bi-trash-fill"></i>
            </span>
        </td>
    </tr>

    <?php 
        $total = $total + $d[3]*$d[4];
        $index++;
        $cliente = $d[5];
        }
        endif;
    ?>

    <tr>
        <td>Total de venta:</td>
        <td><?php echo "$".$total;?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

</table>

<script type="text/javascript">
    $(document).ready(function(){
        nombre = "<?php echo @$cliente?>";
        $('#nombreClienteVenta').text("Cliente: " + nombre);
    });
</script>

