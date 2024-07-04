<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/config/db.config.php';
    class MySQLConexion {
        private $host;
        private $user;
        private $password;
        private $database;

        public function __construct() {
            $this->host = DBConfigMySQL::HOST;
            $this->user = DBConfigMySQL::USER;
            $this->password = DBConfigMySQL::PASSWORD;
            $this->database = DBConfigMySQL::DATABASE;
        }

        public function getConexion() {
            $conexion = new mysqli($this->host, $this->user, $this->password, $this->database);
            if ($conexion->connect_error) {
                die("Connection failed: " . $conexion->connect_error);
            }
            return $conexion;
        }

    }



    

?>