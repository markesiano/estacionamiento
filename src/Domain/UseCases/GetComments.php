
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetComments.php';

    class GetComments implements IGetComments{

        private IGetCommentsRepository $getCommentsRepository;

        public function __construct($getCommentsRepository) {
            $this->getCommentsRepository = $getCommentsRepository;
        }

        function execute() {
            try{
                if($this->getCommentsRepository == null){
                    throw new Exception("Error: getCommentsRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                return $this->getCommentsRepository->getComments();
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>