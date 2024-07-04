<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSource.php';
    class SecuencialSource implements IDatabaseSource {

        public function getData(){
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/txt/comments.txt');
            return $data;
        }
    }

?>
