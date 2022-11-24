<?php
    if(isset($_SESSION['usuario'])){
    require_once "dependencias.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sistema inventario</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-xxl">

            <div class="container-fluid">

                <!-- logo system -->
                <a class="navbar-brand" href="inicio.php">
                    <img class="d-inline-block align-text-top" id="logoPaticos" src="../img/logo_papeleria.png" alt="Logo">
                </a>

                <!-- button collapse -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#contenidoNav" aria-controls="contenidoNav" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- nav content -->
                <div class="collapse navbar-collapse" id="contenidoNav">
                    <ul class="navbar-nav ms-auto">
                        <!-- ancla 1 -->
                        <li class="nav-item">
                            <a class="nav-link active" href="inicio.php">
                                <i class="bi bi-house-door"></i> Inicio
                            </a>
                        </li>

                        <!-- ancla 2 dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-inboxes-fill"></i> Administrar Inventario
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="categorias.php">
                                        <i class="bi bi-box-seam-fill"></i> Categorias
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="articulos.php">
                                        <i class="bi bi-paperclip"></i> Articulos</a>
                                </li>
                            </ul>
                        </li>

                        <!-- ??????????? -->
                        <!-- ancla 3 depende del usuario -->
                        <?php
                        // if ($_SESSION['usuario'] == "admin"):
                        if ($_SESSION['iduser'] == 1):
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="usuarios.php">
                                    <i class="bi bi-people-fill"></i> Administrar Usuarios
                                </a>
                            </li>
                        <?php
                        endif;
                        ?>
                        <!-- ????????????? -->

                        <!-- ancla 4 -->
                        <li class="nav-item">
                            <a class="nav-link" href="clientes.php">
                                <i class="bi bi-person-fill"></i> Clientes
                            </a>
                        </li>

                        <!-- ancla 5 -->
                        <li class="nav-item">
                            <a class="nav-link" href="ventas.php">
                                <i class="bi bi-currency-dollar"></i></i> Vender Articulo
                            </a>
                        </li>

                        <!-- ancla 6 dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> Usuario: <?php echo $_SESSION['usuario']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="../procesos/salir.php">
                                        <i class="bi bi-x-square-fill"></i> Salir
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.contatiner fluid -->
        </nav>
    <!-- navbar -->
    </header>
</body>

</html>


<script type="text/javascript">
    $(window).scroll(function() {
        if ($(document).scrollTop() > 150) {
            $('.logo').height(200);

        } else {
            $('.logo').height(100);
        }
    });
</script>

<?php

    } else {
        header("location:../index.php");
    }
?>