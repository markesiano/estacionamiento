<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetCommentsRepository.php';
    class GetCommentsRepository implements IGetCommentsRepository {

        private $database;
        private $commentsDomainMapper;

        public function __construct($database, $commentsDomainMapper){
            $this->database = $database;
            $this->commentsDomainMapper = $commentsDomainMapper;
        }

        public function getComments(){
            try{
                $result = $this->database->getData();                
                $lugares = $this->commentsDomainMapper->map($result);
                return $lugares;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }


?>