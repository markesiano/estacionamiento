<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetInformDataRepository.php';
    class GetInformDataRepository implements IGetInformDataRepository {

        private $database;
        private $informDomainMapper;

        public function __construct($database, $estacionamientoDataDomainMapper){
            $this->database = $database;
            $this->informDomainMapper = $estacionamientoDataDomainMapper;
        }

        public function getInform($fecha){
            try{
                $result = $this->database->getData($fecha);                
                $lugares = $this->informDomainMapper->map($result);
                return $lugares;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }



?>