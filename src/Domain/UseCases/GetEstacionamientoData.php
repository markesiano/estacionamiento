
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetEstacionamientoData.php';

    class GetEstacionamientoData implements IGetEstacionamientoData{

        private IGetEstacionamientoDataRepository $estacionamientoRepository;

        public function __construct($estacionamientoRepository) {
            $this->estacionamientoRepository = $estacionamientoRepository;
        }

        function execute() {
            try{
                if($this->estacionamientoRepository == null){
                    throw new Exception("Error: estacionamientoRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                return $this->estacionamientoRepository->getEstacionamientoData();
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>