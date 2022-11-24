<?php
class clientes
{

    public function agregaCliente($datos){
        $c = new conectar();
        $conexion = $c->conexion();
        $idusario = $_SESSION['iduser'];

        $sql = "INSERT INTO clientes(id_usuario,
                                        nom_cli,
                                        ape_cli,
                                        direccion,
                                        email_cli,
                                        tel_cli)
                                VALUES( '$idusario',
                                        '$datos[0]',
                                        '$datos[1]',
                                        '$datos[2]',
                                        '$datos[3]',
                                        '$datos[4]')";

        return mysqli_query($conexion, $sql);
    }

    public function obtenDatosCliente($idcliente){
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "SELECT id_cliente,
                            nom_cli,
                            ape_cli,
                            direccion,
                            email_cli,
                            tel_cli 
                        FROM clientes
                    WHERE id_cliente = '$idcliente'";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);

        $datos = array(
            'id_cliente' => $ver[0],
            'nom_cli' => $ver[1],
            'ape_cli' => $ver[2],
            'direccion' => $ver[3],
            'email_cli' => $ver[4],
            'tel_cli' => $ver[5]
        );
        return $datos;
    }

    public function actualizarCliente($datos){
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "UPDATE clientes SET nom_cli = '$datos[1]',
                                        ape_cli = '$datos[2]',
                                        direccion = '$datos[3]',
                                        email_cli = '$datos[4]',
                                        tel_cli = '$datos[5]'
                            WHERE id_cliente = '$datos[0]'";

        return mysqli_query($conexion, $sql);
    }

    public function eliminarCliente($idcliente){
        $c = new conectar();
        $conexion = $c->conexion();
        $sql = "DELETE FROM clientes WHERE id_cliente = '$idcliente'";

        return mysqli_query($conexion,$sql);
    }
    
}
