<?php
    class usuarios{

        public function registroUsuario($datos){
            $c = new conectar();
            $conexion = $c->conexion();
            $fecha = date('Y-m-d');

            $sql = "INSERT INTO usuarios(nom_user, ape_user, email_user, pass_user, fechaCaptura)
            VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$fecha')";
            return mysqli_query($conexion, $sql);
        }

        public function loginUsuario($datos){
            $c = new conectar();
            $conexion = $c->conexion();
            $password = sha1($datos[1]);

            $_SESSION['usuario'] = $datos[0];
            $_SESSION['iduser'] = self::idUsuario($datos);

            $sql = "SELECT * FROM usuarios 
                    WHERE email_user = '$datos[0]' 
                    AND pass_user = '$password'";
            $result = mysqli_query($conexion, $sql);

            if(mysqli_num_rows($result)>0){
                return 1;
            } else {
                return 0;
            }
        }

        public function idUsuario($datos){
            $c = new conectar();
            $conexion = $c->conexion();
            $password = sha1($datos[1]);

            $sql = "SELECT id_usuario FROM usuarios 
                    WHERE email_user = '$datos[0]'
                    AND pass_user = '$password'";
            
            $result = mysqli_query($conexion, $sql);
            return mysqli_fetch_row($result)[0];
        }

        public function obtenDatosUsuarios($idusuario){
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT id_usuario, nom_user, ape_user, email_user 
                    FROM usuarios 
                    WHERE id_usuario = '$idusuario'";

            $result = mysqli_query($conexion, $sql);
            $ver = mysqli_fetch_row($result);

            $datos = array(
                'id_usuario' => $ver[0], 
                'nom_user' => $ver[1], 
                'ape_user' => $ver[2], 
                'email_user' => $ver[3] 
            );

            return $datos;
        }

        public function actualizarUsuario($datos){
            $c = new conectar();
            $conexion = $c->conexion();

            $sql = "UPDATE usuarios SET nom_user = '$datos[1]',
                                        ape_user = '$datos[2]',
                                        email_user = '$datos[3]'
                    WHERE id_usuario = '$datos[0]'";
            
            return mysqli_query($conexion, $sql);;
        }

        public function eliminarUsuario($idusuario){
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "DELETE FROM usuarios WHERE id_usuario = '$idusuario'";

            return mysqli_query($conexion,$sql);
        }

    }
