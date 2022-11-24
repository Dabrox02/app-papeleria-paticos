<?php
    require_once "clases/Conexion.php";
    require_once "vistas/dependencias.php";
    $obj = new conectar();
    $conexion = $obj->conexion();

    // $sql = "SELECT * FROM usuarios WHERE email_user = 'admin'";
    $sql = "SELECT * FROM usuarios WHERE id_usuario = 1";
    $result = mysqli_query($conexion, $sql);
    $validar = 0;

    if(mysqli_num_rows($result) > 0){
        $validar = 1;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login de usuario</title>
    <script src="librerias/jquery-3.6.1.min.js"></script>
    <script src="js/funciones.js"></script>

    <style>
        .img-container {
            text-align: center;
            object-fit: contain;
        }

        .title-card {
            text-align: center;
        }
    </style>
</head>

<body>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="title-card">
                            <h4 class="card-title">SISTEMA DE INVENTARIO</h4>
                        </div>
                        <p>
                        <div class="img-container">
                            <img src="img/papeleria.png" width="200px" height="200px">
                        </div>
                        </p>
                        <form id="frmLogin">
                            <label>Usuario</label>
                            <input type="text" class="form-control input-sm" name="usuario" id="usuario" placeholder="Usuario">
                            <label>Contraseña</label>
                            <input type="password" class="form-control input-sm" name="password" id="password" placeholder="Contraseña">
                            <p></p>
                            <span class="btn btn-primary btn-md" id="entrarSistema">Entrar</span>
                            <?php 
                                if(!$validar):
                            ?>
                            <a href="registro.php" class="btn btn-danger btn-md">Registrar</a>
                            <?php endif;?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        // ENTRAR AL SISTEMA 
        $('#entrarSistema').click(function() {
            vacios = validarFormVacio('frmLogin');
            if (vacios > 0) {
                alert('Debes llenar todos los campos');
                return false;
            }

            datos = $('#frmLogin').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "procesos/regLogin/login.php",
                success: function(r) {
                    if (r == 1) {
                        window.location = "vistas/inicio.php";
                    } else {
                        alert("No se pudo acceder");
                    }
                }
            });
        });
    });
</script>