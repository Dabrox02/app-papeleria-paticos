<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['usuario'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Articulos</title>
        <?php require_once "menu.php" ?>
        <?php
        require_once "../clases/Conexion.php";
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_categoria, nombre_categoria FROM categorias;";
        $result = mysqli_query($conexion, $sql);
        ?>
        <style>
            form label {
                font-weight: 500;
            }
        </style>

    </head>

    <body>
        <div class="container">
            <br>
            <h1>Articulos</h1>
            <div class="row">
                <div class="col-sm-4">
                    <form id="frmArticulos" enctype="multipart/form-data" method="post">
                        <label>Categoria</label>
                        <select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
                            <option value="A">Selecciona Categoria</option>
                            <?php
                            while ($ver = mysqli_fetch_row($result)) :
                            ?>
                                <option value="<?php echo $ver[0]; ?>"> <?php echo $ver[1]; ?> </option>
                            <?php endwhile; ?>
                        </select>
                        <p></p>
                        <label>Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombreArt" name="nombreArt">
                        <p></p>
                        <label>Descripcion</label>
                        <input type="text" class="form-control input-sm" id="descripcionArt" name="descripcionArt">
                        <p></p>
                        <label>Cantidad</label>
                        <input type="text" class="form-control input-sm" id="cantidadArt" name="cantidadArt">
                        <p></p>
                        <label>Precio</label>
                        <input type="text" class="form-control input-sm" id="precioArt" name="precioArt">
                        <p></p>
                        <label>Subir Imagen</label>
                        <br>
                        <input type="file" id="imagenArt" name="imagenArt">
                        <p></p>
                        <span id="btnAgregarArticulo" class="btn btn-primary">Agregar</span>
                    </form>
                </div>
                <div class="col-sm-8" style="margin-top: 10px">
                    <div id="tablaArticulosLoad"></div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalActualizar" tabindex="-1" aria-labelledby="modalActualizar" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalActualizar">Actualizar Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frmArticulosAct" enctype="multipart/form-data">
                            <input type="text" name="idArticulo" id="idArticulo" hidden="">
                            <label>Categoria</label>
                            <select class="form-control input-sm" id="categoriaSelectAct" name="categoriaSelectAct">
                                <option value="A">Selecciona Categoria</option>
                                <?php
                                $sql = "SELECT id_categoria, nombre_categoria FROM categorias;";
                                $result = mysqli_query($conexion, $sql);
                                ?>
                                <?php
                                while ($ver = mysqli_fetch_row($result)) :
                                ?>
                                    <option value="<?php echo $ver[0]; ?>"> <?php echo $ver[1]; ?> </option>
                                <?php endwhile; ?>
                            </select>
                            <p></p>
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" id="nombreArtAct" name="nombreArtAct">
                            <p></p>
                            <label>Descripcion</label>
                            <input type="text" class="form-control input-sm" id="descripcionArtAct" name="descripcionArtAct">
                            <p></p>
                            <label>Cantidad</label>
                            <input type="text" class="form-control input-sm" id="cantidadArtAct" name="cantidadArtAct">
                            <p></p>
                            <label>Precio</label>
                            <input type="text" class="form-control input-sm" id="precioArtAct" name="precioArtAct">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnActualizaArticulo" type="button" class="btn btn-warning" data-bs-dismiss="modal">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>

    <script>
        function eliminaProducto(idArticulo) {
            alertify.confirm("Sistema Inventario", "¿Desea eliminar el producto seleccionado?",
                function() {
                    datos = $('#frmCategorias').serialize();
                    $.ajax({
                        type: "POST",
                        data: "idarticulo=" + idArticulo,
                        url: "../procesos/articulos/eliminarArticulo.php",
                        success: function(r) {
                            if (r == 1) {
                                $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                                alertify.success("Eliminado con exito");
                            } else {
                                alertify.error("No se pudo eliminar");
                            }
                        }
                    });
                },
                function() {
                    alertify.error("Operacion cancelada");
                }
            );
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#btnActualizaArticulo').click(function() {

                vacios = validarFormVacio('frmArticulosAct');
                if (vacios > 0) {
                    alertify.alert("Sistema Inventario", "Debes llenar todos los campos");
                    return false;
                }

                datos = $('#frmArticulosAct').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "../procesos/articulos/actualizarArticulos.php",
                    success: function(r) {
                        if(r == 1){
                            $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                            alertify.success("Actualizado con exito");
                        } else {
                            alertify.error("Error al actualizar");
                        }
                    }
                });
            });
        });
    </script>

    <script>
        function agregaDatosArticulo(idArtic) {
            $.ajax({
                type: "POST",
                data: "idart=" + idArtic,
                url: "../procesos/articulos/obtenerDatosArticulo.php",
                success: function(r) {
                    dato = jQuery.parseJSON(r);
                    $('#idArticulo').val(dato['id_producto']);
                    $('#categoriaSelectAct').val(dato['id_categoria']);
                    $('#nombreArtAct').val(dato['nom_producto']);
                    $('#descripcionArtAct').val(dato['descripcion']);
                    $('#cantidadArtAct').val(dato['cantidad']);
                    $('#precioArtAct').val(dato['precio']);
                }
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
            $('#btnAgregarArticulo').click(function() {

                // VALIDAR ESPACIOS VACIOS
                vacios = validarFormVacio('frmArticulos');
                if (vacios > 0) {
                    alertify.alert("Sistema Inventario", "Debes llenar todos los campos");
                    return false;
                }

                // AGREGAR ARTICULO
                var formData = new FormData(document.getElementById("frmArticulos"));

                $.ajax({
                    url: "../procesos/articulos/insertarArticulo.php",
                    type: "POST",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(r) {

                        if (r == 1) {
                            $('#frmArticulos')[0].reset();
                            $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                            alertify.success("Agregado con exito");
                        } else {
                            alertify.error("Fallo al subir el articulo");
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