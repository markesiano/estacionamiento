<?php

    class Informe {
        private $lugar;
        private $listaCarrosEstacionados = array();
        private $tiempoOcupacion;
        private $nCarrosEstacionados;

        
        public function __construct($lugar,$listaCarrosEstacionados, $tiempoOcupacion, $nCarrosEstacionados){
            $this->lugar = $lugar;
            $this->listaCarrosEstacionados = $listaCarrosEstacionados;
            $this->tiempoOcupacion = $tiempoOcupacion;
            $this->nCarrosEstacionados = $nCarrosEstacionados;
        }

        public function getLugar(){
            return $this->lugar;
        }

        public function getListaCarrosEstacionados(){
            return $this->listaCarrosEstacionados;
        }

        public function getTiempoOcupacion(){
            return $this->tiempoOcupacion;
        }

        public function getNCarrosEstacionados(){
            return $this->nCarrosEstacionados;
        }
    }

?>