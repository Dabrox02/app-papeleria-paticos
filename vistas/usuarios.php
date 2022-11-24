<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['usuario']) and $_SESSION['usuario'] == 'admin') {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Usuarios</title>
        <?php require_once "menu.php" ?>
    </head>

    <body>
        <div class="container">
            <br>
            <h1>Administrar Usuarios</h1>
            <div class="row">
                <div class="col-sm-4">
                    <form id="frmRegistro">
                        <label>Nombre</label>
                        <input type="text" class="form-control input-sm" name="nombre" id="nombre">
                        <p></p>
                        <label>Apellido</label>
                        <input type="text" class="form-control input-sm" name="apellido" id="apellido">
                        <p></p>
                        <label>Usuario</label>
                        <input type="text" class="form-control input-sm" name="usuario" id="usuario">
                        <p></p>
                        <label>Contraseña</label>
                        <input type="password" class="form-control input-sm" name="password" id="password">
                        <p></p>
                        <span class="btn btn-primary btn-md" id="registro">Registrar</span>
                    </form>
                </div>
                <div class="col-sm-7" style="margin: 15px 15px 15px 15px">
                    <div id="tablaUsuariosLoad"></div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="actualizaUsuarioModel" tabindex="-1" aria-labelledby="actualizarUser" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="actualizarUser">Actualizar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmRegistroAct">
                            <input type="text" hidden="" id="idUsuarioAct" name="idUsuarioAct">
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" name="nombreAct" id="nombreAct">
                            <p></p>
                            <label>Apellido</label>
                            <input type="text" class="form-control input-sm" name="apellidoAct" id="apellidoAct">
                            <p></p>
                            <label>Usuario</label>
                            <input type="text" class="form-control input-sm" name="usuarioAct" id="usuarioAct">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnActualizarUser" type="button" class="btn btn-warning" data-bs-dismiss="modal">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>


    </body>

    </html>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnActualizarUser').click(function() {

                datos = $('#frmRegistroAct').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/usuarios/actualizarUsuario.php",

                    success: function(r) {
                        console.log(r);
                        if (r == 1) {
                            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
                            alertify.success("Actualizado con exito");
                        } else {
                            alertify.error("Fallo al registrar");
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        function agregaDatosUser(idusuario) {
            $.ajax({
                type: "POST",
                data: "idusuario=" + idusuario,
                url: "../procesos/usuarios/obtenerDatosUsuario.php",

                success: function(r) {
                    dato = jQuery.parseJSON(r);
                    $('#idUsuarioAct').val(dato['id_usuario']);
                    $('#nombreAct').val(dato['nom_user']);
                    $('#apellidoAct').val(dato['ape_user']);
                    $('#usuarioAct').val(dato['email_user']);
                }
            });
        }

        function eliminaUsuario(idusuario) {
            alertify.confirm("Sistema inventario","¿Desea eliminar el usuario seleccionado?",
                function() {
                    $.ajax({
                        type: "POST",
                        data: "idusuario=" + idusuario,
                        url: "../procesos/usuarios/eliminarUsuarios.php",
                        success: function(r) {
                            if (r == 1) {
                                $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
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

    <script type="text/javascript">
        $(document).ready(function() {
            // REGISTRO DE USUARIOS POR PARTE DEL ADMINISTRADOR
            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
            $('#registro').click(function() {
                vacios = validarFormVacio('frmRegistro');

                if (vacios > 0) {
                    alertify.alert('Sistema Inventario', 'Debes llenar todos los campos');
                    return false;
                }

                datos = $('#frmRegistro').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/regLogin/registrarUsuario.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#frmRegistro')[0].reset();
                            $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
                            alertify.success("Agregado con exito");
                        } else {
                            alertify.error("Fallo al registrar");
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