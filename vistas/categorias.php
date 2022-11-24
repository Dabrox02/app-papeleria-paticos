<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['usuario'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Categorias</title>
        <?php require_once "menu.php" ?>
    </head>

    <body>
        <div class="container">
            <br>
            <h1>Categorias</h1>
            <div class="row">
                <p></p>
                <div class="col-sm-4">
                    <!-- Formulario para entrada de categorias papeleria -->
                    <form id="frmCategorias">
                        <label>Categoria</label>
                        <input type="text" class="form-control input-sm" name="categoria" id="categoria">
                        <p></p>
                        <span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
                    </form>

                </div>

                <div class="col-sm-6" style="margin: 15px 15px 15px 15px">
                    <div id="tablaCategoria">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="actualizaCategoria" tabindex="-1" aria-labelledby="modalActualizar" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalActualizar">Actualizar categoria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="frmCategoriaActualizar">
                            <input type="text" hidden="" id="idCategoria" name="idCategoria">
                            <label>Categoria</label>
                            <p></p>
                            <input type="text" class="form-control input-sm" id="categoriaAct" name="categoriaAct">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-bs-dismiss="modal">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#btnActualizaCategoria').click(function() {

                datos = $('#frmCategoriaActualizar').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/categorias/actualizarCategoria.php",
                    success: function(r) {
                        if (r == 1) {
                            $('#tablaCategoria').load("categorias/tablaCategorias.php"); // RECARGA TABLA
                            alertify.success("Categoria actualizada con exito");
                        } else {
                            alertify.error("No se pudo actualizar categoria");
                        }
                    }
                });
            });
        });
    </script>


    <script type="text/javascript">
        function agregaDato(idCategoria, categoria) {
            $('#idCategoria').val(idCategoria);
            $('#categoriaAct').val(categoria);
        }

        function eliminaCategoria(idCategoria) {
            alertify.confirm('¿Desea eliminar esta Categoria?',
                function() {
                    $.ajax({
                        type: "POST",
                        data: "idCategoria=" + idCategoria,
                        url: "../procesos/categorias/eliminarCategoria.php",
                        success: function(r) {
                            if (r == 1) {
                                $('#tablaCategoria').load("categorias/tablaCategorias.php"); 
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

            $('#tablaCategoria').load("categorias/tablaCategorias.php"); // RECARGA TABLA
            $('#btnAgregaCategoria').click(function() {

                vacios = validarFormVacio('frmCategorias'); // VALIDAR FORMULARIO

                if (vacios > 0) {
                    alertify.alert('Sistema Inventario', 'Debes llenar todos los campos');
                    return false;
                }

                datos = $('#frmCategorias').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/categorias/agregaCategoria.php",
                    success: function(r) {
                        if (r == 1) {
                            // LIMPIAR FORMULARIO
                            $('#frmCategorias')[0].reset();
                            // CARGAR TABLA
                            $('#tablaCategoria').load("categorias/tablaCategorias.php");
                            alertify.success("Categoria agregada con exito");
                        } else {
                            alertify.error("No se pudo agregar categoria");
                        }
                    }
                });
            });
        });
    </script>

<?php

} else {
    header("../index.php");
}

?>