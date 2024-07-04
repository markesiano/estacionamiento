<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IRetireEstacionamientoRepository.php';
    class RetireEstacionamientoRepository implements IRetireEstacionamientoRepository {

        private $database;

        public function __construct($database){
            $this->database = $database;
        }

        public function retireEstacionamiento($lugar)
        {
            try{
                $this->database->retireEstacionamiento($lugar);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }


?>