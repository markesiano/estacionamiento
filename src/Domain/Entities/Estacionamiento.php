<?php

    class Estacionamiento {
        private $lugar;
        private $situacion;
        private $cliente;
        private $automovil;
        private $placas;
        private $horaEntrada;
        private $horaSalida;

        public function __construct($lugar, $situacion, $cliente, $automovil, $placas, $horaEntrada, $horaSalida){
            $this->lugar = $lugar;
            $this->situacion = $situacion;
            $this->cliente = $cliente;
            $this->automovil = $automovil;
            $this->placas = $placas;
            $this->horaEntrada = $horaEntrada;
            $this->horaSalida = $horaSalida;
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

?>