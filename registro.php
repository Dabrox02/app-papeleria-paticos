<?php

    require_once "clases/Conexion.php";
    $obj = new conectar();
    $conexion = $obj->conexion();

    $sql = "SELECT * FROM usuarios WHERE email_user = 'admin'";
    $result = mysqli_query($conexion, $sql);
    $validar = 0;

    if(mysqli_num_rows($result) > 0){
        header("location:index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap-5.2.2-dist/css/bootstrap.css">
	<script src="librerias/jquery-3.6.1.min.js"></script>
	<script src="js/funciones.js"></script>

	<style>
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
							<h5 class="card-title">REGISTRAR ADMINISTRADOR</h5>
						</div>
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
							<a href="index.php" class="btn btn-danger btn-md">Regresar</a>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#registro').click(function() {

			vacios = validarFormVacio('frmRegistro');

			if(vacios > 0){
				alert('Debes llenar todos los campos');
				return false;
			}

			datos = $('#frmRegistro').serialize();
			$.ajax({
				type: "POST",
				data: datos,
				url: "procesos/regLogin/registrarUsuario.php",
				success: function(r) {
					if(r==1){
						alert("Agregado con exito");
						window.location = "index.php";
					} else {
						alert("Fallo al registrar");
					}
				}
			});
		});
	});
</script>