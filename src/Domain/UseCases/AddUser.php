
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAddUser.php';

    class AddUser implements IAddUser{



        private IAddUserRepository $addUserRepository;

        public function __construct($addUserRepository) {
            $this->addUserRepository = $addUserRepository;
        }

        function execute($nombre,$correo,$tipo,$placa): void{
            try{
                if($this->addUserRepository == null){
                    throw new Exception("Error: addUserRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                $this->addUserRepository->addUser($nombre,$correo,$tipo,$placa);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>