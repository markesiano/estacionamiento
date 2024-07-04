<?php
session_start();

// Indicar que la respuesta será JSON
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$nombre = $_SESSION['cliente'];
$commentId = $input['commentId'];
$response = $input['response'];



if (!empty($response)) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/AddResponseFactory.php';
    $addResponse = AddResponseFactory::createUseCase();
    $addResponse->execute($commentId, $nombre, $response);


    echo json_encode(['success' => true]);


    exit();
} else {
    echo json_encode(['success' => false, 'error' => 'empty_response']);
    exit();
}
?>
