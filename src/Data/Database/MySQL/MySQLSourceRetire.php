<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSourceRetire.php';
    class MySQLSourceRetire implements IDatabaseSourceRetire {
        private $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function retireEstacionamiento($lugar){



            // Se realiza un update a un registro con el lugar que se recibe como parámetro, cambiando la situacion a 0, se debe de hacer al update al ultimo registro que se encuentre en la tabla
            // Y se asigna el horaSalida con la hora actual
            $query = "UPDATE estacionamiento SET situacion = 0, horaSalida = NOW() WHERE lugar = $lugar ORDER BY id DESC LIMIT 1";
            $result = $this->connection->makeDBConsult($query);
            return $result;
        }
        


    }

?>
