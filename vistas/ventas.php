<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['usuario'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Ventas</title>
        <?php require_once "menu.php" ?>
    </head>

    <body>
        <div class="container">
            <br>
            <h1>Venta de productos</h1>
            <div class="row">
                <div class="col-sm-12">
                    <p></p>
                    <span class="btn btn-outline-primary" id="ventaProductosBtn">Vender producto</span>
                    <span class="btn btn-outline-danger" id="ventasHechasBtn">Ventas hechas</span>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="ventaProductos"></div>
                        <div id="ventasHechas"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>

    <script type="text/javascript">
        $(document).ready(function() {
            // CARGAR VENTAS HECHAS
            $('#ventaProductosBtn').click(function() {
                esconderSeccion();
                $('#ventaProductos').load('ventas/ventaProductos.php');
                $('#ventaProductos').show();
            });

            // CARGAR PRODUCTOS
            $('#ventasHechasBtn').click(function() {
                esconderSeccion();
                $('#ventasHechas').load('ventas/ventasReportes.php');
                $('#ventasHechas').show();
            });

            function esconderSeccion() {
                $('#ventaProductos').hide();
                $('#ventasHechas').hide();
            }

        });
    </script>


<?php

} else {
    header("location:../index.php");
}
?>