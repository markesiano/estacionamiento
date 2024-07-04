
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IRetireEstacionamiento.php';

    class RetireEstacionamiento implements IRetireEstacionamiento{

        private IRetireEstacionamientoRepository $retireEstacionamientoRepository;

        public function __construct($retireEstacionamientoRepository) {
            $this->retireEstacionamientoRepository = $retireEstacionamientoRepository;
        }

        function execute($lugar) {
            try{
                if($this->retireEstacionamientoRepository == null){
                    throw new Exception("Error: retireEstacionamientoRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                $this->retireEstacionamientoRepository->retireEstacionamiento($lugar);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>