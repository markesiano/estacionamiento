<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSource.php';
    class MySQLSource implements IDatabaseSource {
        private $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }

        public function getData(){
            $query = "SELECT * FROM estacionamiento WHERE situacion = 1 or situacion = 2";
            $result = $this->connection->makeDBConsult($query);
            return $result;
        }
    }

?>
