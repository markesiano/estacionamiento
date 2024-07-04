<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSourceAsign.php';
    class MySQLSourceAsign implements IDatabaseSourceAsign {
        private $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function saveEstacionamientoData($lugar, $situacion, $cliente, $automovil, $placas, $horaEntrada){
            try{
                $query = "INSERT INTO Estacionamiento (lugar, situacion, cliente, automovil, placas, horaEntrada, horaSalida, fecha) VALUES ('$lugar', '$situacion', '$cliente', '$automovil', '$placas', '$horaEntrada',null ,DATE_FORMAT(NOW(), '%Y/%m/%d/'))";
                $result = $this->connection->makeDBConsult($query);
                return $result;
            } catch(Exception $e){
                return $e->getMessage();
            }

        }
        


    }

?>
