
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAsignEstacionamiento.php';

    class AsignEstacionamiento implements IAsignEstacionamiento{

        private IAsignEstacionamientoRepository $asignEstacionamientoRepository;

        public function __construct($asignEstacionamientoRepository) {
            $this->asignEstacionamientoRepository = $asignEstacionamientoRepository;
        }

        function execute($lugar,$situacion,$cliente,$automovil,$placas,$horaEntrada) {
            try{
                if($this->asignEstacionamientoRepository == null){
                    throw new Exception("Error: asignEstacionamientoRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                $this->asignEstacionamientoRepository->asignEstacionamiento($lugar,$situacion,$cliente,$automovil,$placas,$horaEntrada);
            }catch(Exception $e){
                return $e->getMessage();
            }
        }



    }
?>