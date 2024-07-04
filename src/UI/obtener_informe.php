<?php
// obtener_informe.php

// Validar y obtener la fecha del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);

$fecha = $input['fecha'];
// Convertir de formato Y-m-d a Y/m/d

$fecha = str_replace('-', '/', $fecha);



// Intentar obtener los informes para la fecha proporcionada
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/GetInformDataFactory.php';

$informe = GetInformDataFactory::createUseCase();

try {
    $informes = $informe->execute($fecha);
    // Construir la respuesta JSON con los informes obtenidos
    // Convertimos los objetos Informe a un arreglo asociativo para que se pueda convertir a JSON

    // Transformamos la lista de objetos de tipo Informe a un arreglo asociativo

    $informes = array_map(function($informe) {
        return [
            'lugar' => $informe->getLugar(),
            'automoviles' => $informe->getAutomoviles(),
            'tiempoOcupacion' => $informe->getTiempoOcupacion(),
            'nCarrosEstacionados' => $informe->getNCarrosEstacionados()
        ];
    }, $informes);

    $response = [
        'success' => true,
        'informes' => $informes
    ];
} catch (Exception $e) {
    // Manejar cualquier excepción que ocurra y devolver una respuesta JSON adecuada
    $response = [
        'success' => false,
        'message' => 'Error al obtener los informes: ' . $e->getMessage()
    ];
}

// Enviar la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
