<?php
// getComments.php

// Incluir archivos necesarios
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/GetCommentsFactory.php';

// Obtener comentarios
$getComments = GetCommentsFactory::createUseCase();
$comments = $getComments->execute();

// Convertir los comentarios a un formato JSON
$commentsJSON = [];
foreach ($comments as $comment) {
    $commentData = [
        'id' => $comment->getId(),
        'nameUser' => $comment->getNameUser(),
        'comment' => $comment->getComment(),
        'responses' => []
    ];
    // Agregar respuestas si existen
    foreach ($comment->getResponses() as $response) {
        $commentData['responses'][] = [$response[0], $response[1]];
    }
    $commentsJSON[] = $commentData;
}

// Devolver los comentarios en formato JSON
header('Content-Type: application/json');
echo json_encode($commentsJSON);
?>
