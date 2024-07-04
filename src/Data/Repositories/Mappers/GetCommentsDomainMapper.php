<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Entities/Comment.php';

    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Entities/Comment.php';

    class GetCommentsDomainMapper {
        public function map($result) {
            // Dividir el contenido del archivo en líneas
            $lines = explode("\n", $result);
    
            $comments = array();
            $currentId = null;
            $currentUser = null;
            $currentComment = null;
            $currentResponses = array();
    
            foreach ($lines as $line) {
                // Dividir la línea en id, nombre de usuario y comentario
                $parts = explode(",", $line);
    
                if (count($parts) == 3) {
                    // Nuevo id, usuario y comentario encontrado
                    // Guardar el comentario anterior (si existe)
                    if ($currentComment !== null) {
                        $comments[] = new Comment($currentId, $currentUser, $currentComment, $currentResponses);
                        // Restaurar las variables para el próximo comentario
                        $currentId = null;
                        $currentUser = null;
                        $currentComment = null;
                        $currentResponses = array();
                    }
                    // Obtener el id, nombre de usuario y comentario
                    $currentId = $parts[0];
                    $currentUser = $parts[1];
                    $currentComment = $parts[2];
                } elseif (count($parts) == 1 && $parts[0] !== "") {
                    // Respuesta encontrada
                    // Respuesta encontrada
                    $responseParts = explode(": ", $parts[0]);
                    if (count($responseParts) == 2) {
                        $username = $responseParts[0];
                        $response = $responseParts[1];
                        // Agregar la respuesta al array de respuestas
                        $currentResponses[] = array($username, $response);
                    }
                }
            }
    
            // Añadir el último comentario al array de comentarios
            if ($currentComment !== null) {
                $comments[] = new Comment($currentId, $currentUser, $currentComment, $currentResponses);
            }
    
            return $comments;
        }
    }
    

?>




