<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAddResponseRepository.php';
    class AddResponseRepository implements IAddResponseRepository {

        private $database;

        public function __construct($database){
            $this->database = $database;
        }

        public function addResponse($id,$name, $comment)
        {
            try{
                $this->database->addResponse($id,$name, $comment);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }


?>