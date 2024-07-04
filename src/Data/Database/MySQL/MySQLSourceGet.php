<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSourceGet.php';
    class MySQLSourceGet implements IDatabaseSourceGet {
        private $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function getUserData($correo){

            // Se hace un select a la base de datos para obtener los datos del usuario con un join a la tabla automoviles
            
            $query = "SELECT users.nombre, users.correo, automoviles.tipo, automoviles.placa FROM users JOIN automoviles ON users.id_automovil = automoviles.id WHERE users.correo = '$correo'";
            $result = $this->connection->makeDBConsult($query);
            return $result;
        }
    }

?>
