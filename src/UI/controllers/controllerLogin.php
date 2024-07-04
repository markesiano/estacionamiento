<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/GetUserInfoFactory.php';
    
    $input = json_decode(file_get_contents('php://input'), true);

    $correo = $input['correo'];

    $getUserInfo = GetUserInfoFactory::createUseCase();

    try {
        $userInfo = $getUserInfo->execute($correo);
        $_SESSION['cliente'] = $userInfo->getNombre();
        $_SESSION['correo'] = $userInfo->getCorreo();
        $_SESSION['tipo'] = $userInfo->getAutomovil();
        $_SESSION['placa'] = $userInfo->getPlaca();
        echo json_encode(['success' => true, 'userInfo' => $userInfo]);


    } catch (Exception $e) {
    }


?>