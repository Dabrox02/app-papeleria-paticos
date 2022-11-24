<?php
    class ventas{
        public function obtenerDatosProd($idproducto){
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT  img.ruta, 
                            prod.nom_producto,
                            prod.descripcion,
                            prod.cantidad,
                            prod.precio
                    FROM productos as prod
                    INNER JOIN imagenes AS img
                    ON prod.id_imagen = img.id_imagen
                    WHERE prod.id_producto ='$idproducto'";

            $result = mysqli_query($conexion, $sql);
            $ver = mysqli_fetch_row($result);

            $d = explode('/', $ver[0]);
            $img = $d[1].'/'.$d[2].'/'.$d[3];

            $datos = array(
                'ruta' => $img,
                'nom_producto' => $ver[1],
                'descripcion' => $ver[2],
                'cantidad' => $ver[3],
                'precio' => $ver[4]
            );

            return $datos;
        }

        public function crearVenta(){
            $c = new conectar();
            $conexion = $c->conexion();
            $fecha = date('Y-m-d');
            $idventa = self::creaFolio();
            
            $datos = $_SESSION['tablaComprasTemp'];
            $iduser = $_SESSION['iduser'];
            $r = 0;

            for($i=0; $i<count($datos); $i++){
                $d = explode("||", $datos[$i]);
                $sql = "INSERT INTO ventas(id_venta,
                                        id_cliente,
                                        id_producto,
                                        id_usuario,
                                        precio,
                                        fechaCompra,
                                        cantidadCompra)
                                VALUES ('$idventa',
                                        '$d[6]',
                                        '$d[0]',
                                        '$iduser',
                                        '$d[3]',
                                        '$fecha',
                                        '$d[4]'
                                )";

                $r = $r + $result = mysqli_query($conexion, $sql);
            }
            return $r;
        }

        public function creaFolio(){
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT id_venta FROM `ventas` GROUP BY id_venta ORDER BY id_venta DESC;";
            $result = mysqli_query($conexion, $sql);
            $id = mysqli_fetch_row($result)[0];

            if($id == "" or $id == null or $id == 0){
                return 1;
            } else {
                return $id + 1;
            }
        }

        public function nombreCliente($idCliente){
            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT nom_cli, ape_cli FROM clientes WHERE id_cliente ='$idCliente'";

            $result = mysqli_query($conexion, $sql);
            $ver = mysqli_fetch_row($result);
            if($ver > 0){
                return $ver[0]." ".$ver[1];
            }
            return 0;

        }

        public function obtenerTotal($idventa){
            $c = new conectar();
            $conexion = $c->conexion();

            $sql = "SELECT precio*cantidadCompra FROM ventas WHERE id_venta = '$idventa'";
            $result = mysqli_query($conexion, $sql);
            $total = 0;

            while($ver = mysqli_fetch_row($result)){
                $total = $total + $ver[0];
            }
            return $total;
        }


        public function obtenerDetalleVenta($idventaprod){
            $c = new conectar();
            $conexion = $c->conexion();
        
            $sql = "SELECT  ventas.id_venta, 
                ventas.fechaCompra,
                clientes.nom_cli,
                clientes.ape_cli,
                productos.id_producto,
                productos.nom_producto,
                productos.precio,
                productos.descripcion,
                ventas.cantidadCompra,
                ventas.cantidadCompra * ventas.precio
                FROM ventas.ventas
                INNER JOIN ventas.clientes ON ventas.id_cliente = clientes.id_cliente
                INNER JOIN ventas.productos ON ventas.id_producto = productos.id_producto
                WHERE ventas.id_venta = '$idventaprod'";

            $result = mysqli_query($conexion, $sql);
            return mysqli_fetch_all($result);
        }


    }
