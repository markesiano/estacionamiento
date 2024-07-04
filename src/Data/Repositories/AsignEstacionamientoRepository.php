<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAsignEstacionamientoRepository.php';
    class AsignEstacionamientoRepository implements IAsignEstacionamientoRepository {

        private $database;

        public function __construct($database){
            $this->database = $database;
        }

        public function asignEstacionamiento($lugar, $situacion, $cliente, $automovil, $placas, $horaEntrada)
        {
            try{
                $this->database->saveEstacionamientoData($lugar, $situacion, $cliente, $automovil, $placas, $horaEntrada);
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
    }


?>