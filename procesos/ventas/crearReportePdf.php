<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../../librerias/fpdf185/fpdf.php';
require_once "../../clases/Conexion.php";
require_once "../../clases/Ventas.php";


$id = $_GET['idventa'];
$obj = new ventas();
$verProd = $obj->obtenerDetalleVenta($id);

$c = new conectar();
$conexion = $c->conexion();
        
$sql = "SELECT  ventas.id_venta, 
                ventas.fechaCompra,
                clientes.nom_cli,
                clientes.ape_cli,
                productos.id_producto,
                productos.nom_producto,
                productos.precio,
                productos.descripcion
FROM ventas.ventas
INNER JOIN ventas.clientes ON ventas.id_cliente = clientes.id_cliente
INNER JOIN ventas.productos ON ventas.id_producto = productos.id_producto
WHERE ventas.id_venta = '$id'";
$result = mysqli_query($conexion, $sql);

class pdf extends FPDF{

    public function header(){
        $id = $_GET['idventa'];
        $this->SetFillColor(255,222,89);
        $this->Rect(0,0, 220, 50, 'F');
        $this->Image('../../img/LogoPDF.png', 30,5);
    }



    public function footer(){
        $this->SetFillColor(4,114,139);
        $this->Rect(0,250, 220, 50, 'F');
        $this->SetY(-40);
        $this->SetFont('Arial','',12);
        $this->SetTextColor(255,255,255);
        $this->SetX(130);
        $this->Write(5,'Papeleria Paticos');
        $this->Ln();
        $this->SetX(130);
        $this->Write(5,'Calle 4 #5a - 06');
        $this->Ln();
        $this->SetX(130);
        $this->Write(5,'correopapeleria@email.com');
        $this->Ln();
        $this->SetX(130);
        $this->Write(5,'(+57)300000000');
    }

}

// DATOS DE LA ORDEN
$ver = mysqli_fetch_row($result);
$idVenta = $ver[0];
$date = $ver[1];
$nomCliente = $ver[2].' '.$ver[3];

// MAQUETACION DEL PDF

// ENCABEZADO
$fpdf = new pdf('P','mm','A4',true);
$fpdf->AddPage('portrait');
$fpdf->SetMargins(10,30,20,20);
$fpdf->SetFont('Arial', 'B', 14);
// $fpdf->SetTextColor(255,255,255);
$fpdf->SetTextColor(0,0,0);

$fpdf->SetY(20);
$fpdf->SetX(100);
$fpdf->Write(5, "Fecha Factura: ".$date);
$fpdf->Ln();
$fpdf->SetX(100);
$fpdf->Write(5, "Factura Nro: ".$idVenta);
$fpdf->Ln();
$fpdf->SetX(100);
$fpdf->Write(5, "Cliente: ".$nomCliente);
$fpdf->Ln();
$fpdf->SetX(100);
$fpdf->Write(5, "Floridablanca, Santander");

// $fpdf->Cell(Ancho, Alto, 'Texto', Borde 1/0, 1, Center | Right | Left , | Background);

// DETALLE DE VENTA
$fpdf->SetFont('Arial', 'B', 10);
$fpdf->SetTextColor(0,0,0);
$fpdf->SetFillColor(255, 255, 255);
$fpdf->SetY(60);

$fpdf->Cell(40, 7, 'Producto', 1, 0, 'C', 1);
$fpdf->Cell(60, 7, 'Descripcion', 1, 0, 'C', 1);
$fpdf->Cell(20, 7, 'Cantidad', 1, 0, 'C', 1);
$fpdf->Cell(30, 7, 'Valor Unidad', 1, 0, 'C', 1);
$fpdf->Cell(30, 7, 'Subtotal', 1, 0, 'C', 1);
$fpdf->Ln();

$fpdf->SetFont('Arial', '', 10);
$total = 0;

foreach($verProd as $prod){
    
    $fpdf->Cell(40, 7, $prod[5], 1, 0, 'C', 1);
    $fpdf->Cell(60, 7, $prod[7], 1, 0, 'L', 1);
    $fpdf->Cell(20, 7, $prod[8], 1, 0, 'C', 1);
    $fpdf->Cell(30, 7, '$ '.$prod[6], 1, 0, 'C', 1);
    $fpdf->Cell(30, 7, '$ '.$prod[9], 1, 0, 'C', 1);
    $fpdf->Ln();
    $total = $total + $prod[9];
}

$fpdf->SetLineWidth(0.2);
$fpdf->Cell(120, 7, '', 'T', 0, 'C', 1);
$fpdf->Cell(30, 7, 'Total',1, 0, 'C', 1);
$fpdf->Cell(30, 7, '$ '.$total, 1, 0, 'C', 1);



$fpdf->Output();
?>



