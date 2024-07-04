<?php

use function PHPSTORM_META\map;

    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Entities/Estacionamiento.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetEstacionamientoData.php';
    class EstacionamientoPresentableItem{
        private $lugar;
        private $situacion;
        private $cliente;
        private $automovil;
        private $placas;
        private $horaEntrada;
        private $horaSalida;

        public function __construct(Estacionamiento $estacionamiento){
            $this->lugar = $estacionamiento->getLugar();
            if($estacionamiento->getSituacion() == 0){
                $this->situacion = "Disponible";
            } else if   ($estacionamiento->getSituacion() == 1){
                $this->situacion = "Ocupado";
            }else if ($estacionamiento->getSituacion() == 2){
                $this->situacion = "Reservado";
            }
            $this->cliente = $estacionamiento->getCliente();
            $this->automovil = $estacionamiento->getAutomovil();
            $this->placas = $estacionamiento->getPlacas();
            $this->horaEntrada = $estacionamiento->getHoraEntrada();
            if ($estacionamiento->getSituacion() == 1 ){
                $this->horaSalida = "No ha salido";
            } else {
                $this->horaSalida = $estacionamiento->getHoraSalida();
            }
        }

        public function getLugar(){
            return $this->lugar;
        }

        public function getSituacion(){
            return $this->situacion;
        }

        public function getCliente(){
            return $this->cliente;
        }

        public function getAutomovil(){
            return $this->automovil;
        }

        public function getPlacas(){
            return $this->placas;
        }

        public function getHoraEntrada(){
            return $this->horaEntrada;
        }

        public function getHoraSalida(){
            return $this->horaSalida;
        }

        
    }

    class EstacionamientoViewModel {
        private $getEstacionamientoData;
        private $lugares = array();

        public function __construct(IGetEstacionamientoData $getEstacionamientoData){
            $this->getEstacionamientoData = $getEstacionamientoData;
        }

        public function onAppear(){
            try{
                $estacionamiento = $this->getEstacionamientoData->execute();
                foreach($estacionamiento as $item){
                    $presentableItem = new EstacionamientoPresentableItem($item);
                    array_push($this->lugares, $presentableItem);
                }
                return $this->lugares;

            } catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }


?>