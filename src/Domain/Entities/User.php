<?php

    class User {
        private $name;
        private $email;
        private $automovil;
        private $placa;


        public function __construct($name,  $email, $automovil, $placa){
            $this->name = $name;
            $this->email = $email;
            $this->automovil = $automovil;
            $this->placa = $placa;
        }


        public function getNombre(){
            return $this->name;
        }

        public function getAutomovil(){
            return $this->automovil;
        }

        public function getPlaca(){
            return $this->placa;
        }

        public function getCorreo(){
            return $this->email;
        }

    }

?>