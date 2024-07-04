<?php   
    class Automovil {
        private $tipo;
        private $placa;

        public function __construct($tipo, $placa){
            $this->tipo = $tipo;
            $this->placa = $placa;
        }

        public function getTipo(){
            return $this->tipo;
        }

        public function getPlaca(){
            return $this->placa;
        }
    }
?>