<?php 

require_once '../config/config.php';
require_once '../config/database.php';
require_once '../fpdf/plantilla_reporte_compras.php';


if(!isset($_SESSION['user_type']) ||  $_SESSION['user_type'] != 'admin'){
  header('Location: ../../index.php');
  exit;
}
                            

$db = new DataBase();
$con = $db->conectar();


$fechaIni = $_POST['fecha_ini'] ?? '2021-01-01';
$fechaFin = $_POST['fecha_fin'] ?? '2024-11-12';

$query = "SELECT date_format(c.fecha, '%d/%m/%Y %H:%I') AS fechaHora, c.status, c.total, CONCAT(cli.nombres, ' ', cli.apellidos) AS cliente
FROM compra AS c
INNER JOIN clientes AS cli on c.id_cliente = cli.id
WHERE DATE (c.fecha) BETWEEN ? AND ?
ORDER BY DATE(c.fecha) ASC";
$resultado = $con->prepare($query);
$resultado->execute([$fechaIni, $fechaFin]);

$datos = [
    'fechaIni' => $fechaIni,
    'fechaFin' => $fechaFin,
];

$pdf = new PDF('P', 'mm', 'Letter', $datos);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
    $pdf->Cell(48, 6, $row['fechaHora'], 1,0,);
    $pdf->Cell(49, 6, $row['status'], 1,0,);
    $pdf->Cell(49, 6, mb_convert_encoding($row['cliente'],'ISO-8859-1','UTF-8 '),1,0,);
    $pdf->Cell(48, 6, $row['total'], 1,1);
}

$pdf->Output('D');



?>