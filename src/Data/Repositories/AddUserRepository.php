<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAddUserRepository.php';

    class AddUserRepository implements IAddUserRepository{

        private $database;

        public function __construct($database){
            $this->database = $database;
        }

        public function addUSER($nombre, $correo, $tipo, $placa): void
        {
            try{
                $this->database->addUser($nombre, $correo, $tipo, $placa);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }   

?>

