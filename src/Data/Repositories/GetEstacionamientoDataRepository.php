<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetEstacionamientoDataRepository.php';
    class GetEstacionamientoDataRepository implements IGetEstacionamientoDataRepository {

        private $database;
        private $estacionamientoDataDomainMapper;

        public function __construct($database, $estacionamientoDataDomainMapper){
            $this->database = $database;
            $this->estacionamientoDataDomainMapper = $estacionamientoDataDomainMapper;
        }

        public function getEstacionamientoData(){
            try{
                $result = $this->database->getData();                
                $lugares = $this->estacionamientoDataDomainMapper->map($result);
                return $lugares;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }


?>