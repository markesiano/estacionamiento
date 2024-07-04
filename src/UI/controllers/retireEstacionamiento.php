<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/RetireEstacionamientoFactory.php';
require($_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/fpdf/fpdf.php');

$input = json_decode(file_get_contents('php://input'), true);
$lugarretirar = $input['lugarretirar'];
$cliente = $input['cliente'];
$automovil = $input['automovil'];
$placas = $input['placas'];
$horaEntrada = $input['horaEntrada'];
$reservado = $input['reservado'];

$retirar = RetireEstacionamientoFactory::createUseCase();

try {

    $retirar->execute($lugarretirar);

    // set hora salida to current time in 24 hour format of system of central america (mexico)
    date_default_timezone_set('America/Mexico_City');
    $horaSalida = date('H:i:s');
    // Create PDF
    $pdf = new FPDF('P', 'mm', array(80, 100)); // Tamaño del papel en milímetros (ancho, alto)
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 10);
    if ($reservado == 1) {
        $pdf->Cell(0, 7, "Reserva cancelada", 0, 1, 'C');
    }else{
        $pdf->Cell(0, 10, 'Comprobante de Retiro de Estacionamiento', 0, 1, 'C');
    }
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, "Lugar: {$lugarretirar}", 0, 1);
    $pdf->Cell(0, 7, "Cliente: {$cliente}", 0, 1);
    $pdf->Cell(0, 7, "Automovil: {$automovil}", 0, 1);
    $pdf->Cell(0, 7, "Placas: {$placas}", 0, 1);
    $pdf->Cell(0, 7, "Hora de Entrada: {$horaEntrada}", 0, 1);
    if ($reservado == 1) {
        $pdf->Cell(0, 7, "Hora de Salida: Reserva cancelada", 0, 1);
    }else{
        $pdf->Cell(0, 7, "Hora de Salida: {$horaSalida}", 0, 1);
    }
    
    $pdfFilename = "pdfs/comprobante_retiro_estacionamiento_$lugarretirar.pdf";
    $pdf->Output('F', $pdfFilename);
    

    echo json_encode(['success' => true, 'pdf' => $pdfFilename]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
