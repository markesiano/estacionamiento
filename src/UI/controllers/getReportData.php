<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/GetInformDataFactory.php';

$input = json_decode(file_get_contents('php://input'), true);

$date = $input['date'];


$addEstacionamiento = GetInformDataFactory::createUseCase();

try {

    $informes = $addEstacionamiento->execute($date);
    


    echo json_encode(['success' => true, 'pdf' => $pdfFilename]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
