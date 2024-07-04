<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetUserInfoRepository.php';
    class GetUserInfoRepository implements IGetUserInfoRepository {

        private $database;
        private $userInforDomainMapper;

        public function __construct($database, $estacionamientoDataDomainMapper){
            $this->database = $database;
            $this->userInforDomainMapper = $estacionamientoDataDomainMapper;
        }

        public function getUserData($correo){
            try{
                $result = $this->database->getUserData($correo);                
                $lugares = $this->userInforDomainMapper->map($result);
                return $lugares;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }


?>