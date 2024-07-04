
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetInformData.php';

    class GetInformData implements IGetInformData{

        private IGetInformDataRepository $GetInformDataRepository;

        public function __construct($GetInformDataRepository) {
            $this->GetInformDataRepository = $GetInformDataRepository;
        }

        function execute($fecha) {
            try{
                if($this->GetInformDataRepository == null){
                    throw new Exception("Error: GetInformDataRepository no puede ser null");
                }
                return $this->GetInformDataRepository->getInform($fecha);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>