<?php

require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();

?>

<br>
<h4>Venta productos</h4>
<div class="row">
    <div class="col-sm-2">
        <form id="frmCliente">
            <p></p>
            <label>Selecciona Cliente</label>
            <p></p>
            <select class="form-control input-sm" name="clienteVenta" id="clienteVenta" style="width: 160px;">
                <option value="A">Selecciona</option>
                <!-- <option value="0">Sin cliente</option> -->
                <?php
                $sql = "SELECT id_cliente, nom_cli, ape_cli FROM clientes";
                $result = mysqli_query($conexion, $sql);

                while ($cliente = mysqli_fetch_row($result)) :
                ?>

                    <option value="<?php echo $cliente[0]; ?>">
                        <?php echo $cliente[1] . " " . $cliente[2]; ?>
                    </option>

                <?php
                endwhile;
                ?>
            </select>
            <p></p>
            <!-- BOTON CREAR VENTA -->
            <span class="btn btn-primary" id="btnCrearVenta">Agregar</span>
        </form>
    </div>
    <div class="col-sm-1">

    </div>
    <div class="col-sm-9" id="frmVenta">
        <div class="row">
            <div class="col-sm-8">
                <form id="frmVentaProductos">
                    <label>Producto</label>
                    <br>
                    <select class="form-control input-sm" name="productoVenta" id="productoVenta" style="width: 160px;">
                        <option value="A">Selecciona</option>
                        <?php
                        $sql = "SELECT id_producto, nom_producto FROM productos";
                        $result = mysqli_query($conexion, $sql);

                        while ($producto = mysqli_fetch_row($result)) :
                        ?>
                            <option value="<?php echo $producto[0] ?>">
                                <?php echo $producto[1] ?>
                            </option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                    <p></p>
                    <label>Descripcion</label>
                    <textarea readonly="" class="form-control input-sm" name="descripcionProd" id="descripcionProd"></textarea>
                    <p></p>
                    <label>Cantidad disponible</label>
                    <input readonly="" type="text" class="form-control input-sm" id="cantidadProd" name="cantidadProd">
                    <p></p>
                    <label>Cantidad a comprar</label>
                    <input type="text" class="form-control input-sm" id="cantidadCompra" name="cantidadCompra">
                    <p></p>
                    <label>Precio</label>
                    <input readonly="" type="text" class="form-control input-sm" id="precioProd" name="precioProd">
                    <p></p>
                    <span class="btn btn-primary" id="btnAgregaVenta">Agregar</span>
                    <span class="btn btn-danger" id="btnVacearVenta" onclick="vacearTabla()">Vacear venta</span>
                </form>
            </div>
            <div class="col-sm-4">
                <div id="imgProducto" style="margin-top:10px"></div>
            </div>
        </div>
        <p></p>
        <div id="tablaVentasTempLoad">
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        ocultarVenta();

        $('#btnCrearVenta').click(function() {

            vacios = validarFormVacio('frmCliente'); // VALIDAR FORMULARIO
            if (vacios > 0) {
                alertify.alert('Sistema Inventario', 'Selecciona un cliente');
                return false;
            }
            mostrarVenta();
        });

        $('#clienteVenta').change(function() {
            if ($('#clienteVenta').val() == 'A') {
                ocultarVenta();
                vacearTabla();
            }  else {
                vacearTabla();
            }
        })
    });

    function mostrarVenta() {
        document.getElementById('frmVenta').style.display = 'block';
    }

    function ocultarVenta() {
        document.getElementById('frmVenta').style.display = 'none';
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

        // CARGA DESCRIPCION DEL PRODUCTO AL CAMBIAR ESTADO DEL SELECT
        $('#productoVenta').change(function() {
            $('#imgProducto').empty();
            if ($('#productoVenta').val() != 'A') {
                $.ajax({
                    type: "POST",
                    data: "idproducto=" + $('#productoVenta').val(),
                    url: "../procesos/ventas/llenarFormProductos.php",

                    success: function(r) {
                        dato = jQuery.parseJSON(r);
                        $('#descripcionProd').val(dato['descripcion']);
                        $('#cantidadProd').val(dato['cantidad']);
                        $('#precioProd').val(dato['precio']);
                        $('#imgProducto').prepend('<img class="img-thumbnail" id="imgprod" src="' + dato['ruta'] + '"/>');
                    }
                });
            } else {
                $('#imgProducto').empty();
                $('#frmVentaProductos')[0].reset();
            }
        });

        // BOTON AGREGAR VENTA
        $('#btnAgregaVenta').click(function() {
            vacios = validarFormVacio('frmVentaProductos'); // VALIDAR FORMULARIO
            if (vacios > 0) {
                alertify.alert('Sistema Inventario', 'Debes llenar todos los campos');
                return false;
            }

            datos = $('#frmVentaProductos').serialize() + "&idcliente=" + $('#clienteVenta').val();
            $.ajax({
                type: "POST",
                data: datos,
                url: "../procesos/ventas/agregaProductoTemp.php",

                success: function(r) {
                    $('#imgProducto').empty();
                    $('#productoVenta').val('A').trigger('change.select2');
                    $('#frmVentaProductos')[0].reset();
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                }
            });
        });


    });
</script>

<script type="text/javascript">
    function vacearTabla() {
        $.ajax({
            url: "../procesos/ventas/vacearTemp.php",

            success: function(r) {
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                alertify.success("Venta eliminada con exito");
            }
        });
    }

    function quitarProduc(index) {
        $.ajax({
            type: "POST",
            data: "ind=" + index,
            url: "../procesos/ventas/quitarProducto.php",

            success: function(r) {
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                alertify.success("Se quito el producto");
            }
        });
    }

    function crearVenta() {
        $.ajax({
            url: "../procesos/ventas/crearVenta.php",

            success: function(r) {
                if (r > 0) {
                    $('#imgProducto').empty();
                    $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                    $('#clienteVenta').val('A').trigger('change.select2');
                    $('#productoVenta').val('A').trigger('change.select2');
                    $('#frmVentaProductos')[0].reset();
                    alertify.alert("Sistema Inventario", "Venta creada con exito, consulte la informacion en Ventas hechas.");
                } else if (r = 0) {
                    alertify.alert("Sistema Inventario", "No hay lista de venta.");
                } else {
                    alertify.error("No se pudo crear la venta.");
                }
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#clienteVenta').select2();
        $('#productoVenta').select2();

    });
</script>