<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/AddUserFactory.php';

$input = json_decode(file_get_contents('php://input'), true);

$nombre = $input['nombre'];
$correo = $input['correo'];
$tipo = $input['tipo'];
$placa = $input['placa'];

$addUser = AddUserFactory::createUseCase();

try {
    $addUser->execute($nombre, $correo, $tipo, $placa);
    echo json_encode(['success' => true, 'message' => 'User added successfully!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>