<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSourceAddComment.php';

    class SecuencialSourceAdd implements IDatabaseSourceAddComment {
        private $filePath;
        public function __construct() {
            $this->filePath = $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/txt/comments.txt';
        }

        public function addComment($user, $comment) {
            // Leer todo el contenido del archivo
            $content = file_get_contents($this->filePath);

            // Dividir el contenido en líneas
            $lines = explode("\n", $content);

            // Obtener el último ID
            $lastId = 0;
            foreach ($lines as $line) {
                $parts = explode(",", $line);
                $id = intval($parts[0]);
                if ($id > $lastId) {
                    $lastId = $id;
                }
            }

            // Incrementar el último ID para el nuevo comentario
            $newId = $lastId + 1;

            // Construir la nueva línea para el nuevo comentario
            $newLine = "$newId,$user, $comment\n";

            // Agregar la nueva línea al contenido del archivo
            $content .= $newLine;

            // Escribir el contenido actualizado en el archivo
            file_put_contents($this->filePath, $content);
        }
    }


?>
