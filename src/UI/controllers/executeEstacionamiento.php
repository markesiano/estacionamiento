<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/AsignEstacionamientoFactory.php';
require($_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/fpdf/fpdf.php');

$input = json_decode(file_get_contents('php://input'), true);

$lugar = $input['lugar'];
$cliente = $input['cliente'];
$automovil = $input['automovil'];
$placas = $input['placas'];
$horaEntrada = $input['horaEntrada'];
$reservado = $input['reservado'];

$addEstacionamiento = AsignEstacionamientoFactory::createUseCase();

try {
    if ($reservado == 1) {
        $addEstacionamiento->execute($lugar, 2, $cliente, $automovil, $placas, $horaEntrada);
    } else {
        $addEstacionamiento->execute($lugar, 1, $cliente, $automovil, $placas, $horaEntrada);
    }

    // Create PDF
    $pdf = new FPDF('P', 'mm', array(80, 90)); // Tamaño del papel en milímetros (ancho, alto)
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Comprobante de Estacionamiento', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    if ($reservado == 1) {
        $pdf->Cell(0, 7, "Reservado", 0, 1, 'C');
    }
    $pdf->Cell(0, 7, "Lugar: $lugar", 0, 1);
    $pdf->Cell(0, 7, "Cliente: $cliente", 0, 1);
    $pdf->Cell(0, 7, "Automovil: $automovil", 0, 1);
    $pdf->Cell(0, 7, "Placas: $placas", 0, 1);
    $pdf->Cell(0, 7, "Hora de Entrada: $horaEntrada", 0, 1);
    
    $pdfFilename = "pdfs/comprobante_estacionamiento_$lugar.pdf";
    $pdf->Output('F', $pdfFilename);



    echo json_encode(['success' => true, 'pdf' => $pdfFilename]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
