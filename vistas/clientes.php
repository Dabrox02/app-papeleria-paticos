<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['usuario'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Clientes</title>
        <?php require_once "menu.php" ?>
    </head>

    <body>
        <div class="container">
            <br>
            <h1>Clientes</h1>
            <div class="row">
                <div class="col-sm-4">
                    <form id="frmClientes">
                        <label>Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombreCli" name="nombre">
                        <p></p>
                        <label>Apellido</label>
                        <input type="text" class="form-control input-sm" id="apellidoCli" name="apellido">
                        <p></p>
                        <label>Direccion</label>
                        <input type="text" class="form-control input-sm" id="direccionCli" name="direccion">
                        <p></p>
                        <label>Email</label>
                        <input type="text" class="form-control input-sm" id="emailCli" name="email">
                        <p></p>
                        <label>Telefono</label>
                        <input type="text" class="form-control input-sm" id="telCli" name="telefono">
                        <p></p>
                        <span id="btnAgregarCliente" class="btn btn-primary">Agregar</span>
                    </form>
                </div>
                <div class="col-sm-8" style="margin-top: 15px">
                    <div id="tablaClientesLoad"></div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalClientesAct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmClientesAct">
                            <input type="text" hidden="" id="idcliente" name="idcliente">
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" id="nombreCliAct" name="nombreCliAct">
                            <p></p>
                            <label>Apellido</label>
                            <input type="text" class="form-control input-sm" id="apellidoCliAct" name="apellidoCliAct">
                            <p></p>
                            <label>Direccion</label>
                            <input type="text" class="form-control input-sm" id="direccionCliAct" name="direccionCliAct">
                            <p></p>
                            <label>Email</label>
                            <input type="text" class="form-control input-sm" id="emailCliAct" name="emailCliAct">
                            <p></p>
                            <label>Telefono</label>
                            <input type="text" class="form-control input-sm" id="telCliAct" name="telCliAct">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnActualizarCliente" type="button" class="btn btn-warning" data-bs-dismiss="modal">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>

    <script>
        function agregaDatosCliente(idcliente) {
            $.ajax({
                type: "POST",
                data: "idcliente=" + idcliente,
                url: "../procesos/clientes/obtenerDatosCliente.php",

                success: function(r) {
                    dato = jQuery.parseJSON(r);
                    $('#idcliente').val(dato['id_cliente']);
                    $('#nombreCliAct').val(dato['nom_cli']);
                    $('#apellidoCliAct').val(dato['ape_cli']);
                    $('#direccionCliAct').val(dato['direccion']);
                    $('#emailCliAct').val(dato['email_cli']);
                    $('#telCliAct').val(dato['tel_cli']);
                }
            });
        }

        function eliminarCliente(idcliente) {
            alertify.confirm("Sistema inventario","¿Desea eliminar el usuario seleccionado?",
                function() {
                    $.ajax({
                        type: "POST",
                        data: "idcliente=" + idcliente,
                        url: "../procesos/clientes/eliminarCliente.php",
                        success: function(r) {
                            if (r == 1) {
                                $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                                alertify.success("Eliminado con exito");
                            } else {
                                alertify.error("No se pudo eliminar");
                            }
                        }
                    });
                },
                function() {
                    alertify.error('Operacion cancelada')
                }
            );
        }
    </script>

    <script>
        $(document).ready(function() {

            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
            $('#btnAgregarCliente').click(function() {

                vacios = validarFormVacio('frmClientes');

                if (vacios > 0) {
                    alertify.alert('Sistema Inventario', 'Debes llenar todos los campos');
                    return false;
                }

                datos = $('#frmClientes').serialize();
                console.log(datos);
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/clientes/agregaCliente.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#frmClientes')[0].reset();
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("Cliente agregado con exito");
                        } else {
                            alertify.error("No se pudo agregar cliente");
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#btnActualizarCliente').click(function() {

                vacios = validarFormVacio('frmClientesAct');

                if (vacios > 0) {
                    alertify.alert('Sistema Inventario', 'Debes llenar todos los campos');
                    return false;
                }

                datos = $('#frmClientesAct').serialize();

                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/clientes/actualizarCliente.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#frmClientes')[0].reset();
                            $('#tablaClientesLoad').load("clientes/tablaClientes.php");
                            alertify.success("Cliente actualizado con exito");
                        } else {
                            alertify.error("No se pudo actualizar cliente");
                        }
                    }
                });

            });
        });
    </script>


<?php

} else {
    header("location:../index.php");
}

?>