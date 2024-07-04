<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSourceResponse.php';

class SecuencialSourceResponse implements IDatabaseSourceResponse {
    private $filePath;

    public function __construct() {
        $this->filePath = $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/txt/comments.txt';
    }

    public function addResponse($id, $name, $comment) {
        // Leer todo el contenido del archivo
        $content = file_get_contents($this->filePath);

        // Dividir el contenido en líneas
        $lines = explode("\n", $content);

        // Buscar el comentario con el ID proporcionado
        foreach ($lines as &$line) {
            $parts = explode(",", $line);
            if (count($parts) >= 3 && $parts[0] == $id) {
                // Agregar la nueva respuesta al comentario
                $line .= "\n    $name: $comment";
                break;
            }
        }

        // Reconstruir el contenido del archivo
        $content = implode("\n", $lines);

        // Escribir el contenido actualizado en el archivo
        file_put_contents($this->filePath, $content);
    }
}



?>
