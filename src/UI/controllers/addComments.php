// addComment.php
<?php
session_start();

$input = json_decode(file_get_contents('php://input'), true);


$nombre = $_SESSION['cliente'];
$comment = $input['comment'];

if (!empty($comment)) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/CompositionRoot/AddCommentFactory.php';
    $addComment = AddCommentFactory::createUseCase();
    $addComment->execute($nombre, $comment);

    echo json_encode(['success' => true]);
    exit();
} else {
    echo json_encode(['success' => false, 'error' => 'empty_comment']);
    exit();
}
?>