<?php
$input = json_decode(file_get_contents('php://input'), true);
$date = $input['date'];

require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/GetInformDataFactory.php';
$getInformData = GetInformDataFactory::createUseCase();

$informData = $getInformData->execute($date);

// Formatear los datos de informe
$formattedData = array_map(function($inform) {
    return [
        'lugar' => $inform->getLugar(),
        'listaCarrosEstacionados' => $inform->getListaCarrosEstacionados(),
        'tiempoOcupacion' => $inform->getTiempoOcupacion(),
        'nCarrosEstacionados' => $inform->getNCarrosEstacionados()
    ];
}, $informData);

echo json_encode($formattedData);
?>
