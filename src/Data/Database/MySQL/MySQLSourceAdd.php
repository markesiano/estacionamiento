<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSourceAdd.php';
    class MySQLSourceAdd implements IDatabaseSourceAdd {
        private $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function addUser($nombre, $correo, $tipo, $placa){

            $query = "INSERT INTO automoviles (tipo, placa) VALUES ('$tipo', '$placa')";

            $result = $this->connection->makeDBConsult($query);

            $query = "SELECT id FROM automoviles WHERE placa = '$placa'";


            $result = $this->connection->makeDBConsult($query);

            $idAutomovil = $result->fetch_assoc()['id'];

            $query = "INSERT INTO users (nombre, correo, id_automovil) VALUES ('$nombre', '$correo', '$idAutomovil')";

            $result = $this->connection->makeDBConsult($query);


            return $result;
        }
        


    }

?>
