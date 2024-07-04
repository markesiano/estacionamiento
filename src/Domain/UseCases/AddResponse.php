<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAddResponse.php';

    class AddResponse implements IAddResponse{

        private IAddResponseRepository $AddResponseRepository;

        public function __construct($AddResponseRepository) {
            $this->AddResponseRepository = $AddResponseRepository;
        }

        function execute($id,$name,$comment) {
            try{
                if($this->AddResponseRepository == null){
                    throw new Exception("Error: AddResponseRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                $this->AddResponseRepository->addResponse($id,$name,$comment);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>