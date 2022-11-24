<?php

    class categorias{
        public function agregaCategoria($datos){
            $c = new conectar();
            $conexion = $c->conexion();
            
            $sql = "INSERT INTO categorias(
                                id_usuario,
                                nombre_categoria,
                                fechaCaptura) 
                        VALUES('$datos[0]',
                                '$datos[1]',
                                '$datos[2]')";
            
            return mysqli_query($conexion, $sql); 
        }

        public function actualizaCategoria($datos){
            $c = new conectar();
            $conexion = $c->conexion();
            
            $sql = "UPDATE categorias SET nombre_categoria = '$datos[1]'
                    WHERE id_categoria = '$datos[0]'";

            echo mysqli_query($conexion, $sql);
        }
        
        public function eliminaCategoria($idcategoria){
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "DELETE FROM categorias WHERE id_categoria = '$idcategoria'";

            return mysqli_query($conexion, $sql);
        }

    }
