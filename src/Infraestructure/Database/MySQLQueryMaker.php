<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IConnectorDB.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/Connectors/MySQLConexion.php';
        class MySQLQueryMaker implements IConnectorDB{
            private MySQLConexion $conexion;
            private static MySQLQueryMaker $instance;

            public function __construct() {
                $this->conexion = new MySQLConexion();
            }

            public static function getInstance(): MySQLQueryMaker {
                if (!isset(self::$instance)) {
                    self::$instance = new MySQLQueryMaker();
                }
                return self::$instance;
            }

            public function makeDBConsult($query)
            {
                try{
                    $conexion = $this->conexion->getConexion();
                    $result = $conexion->query($query);

                    $conexion->close();
                    return $result;
                }catch(Exception $e){

                    $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . "\nConsulta SQL: " . $query . "\n";
                    error_log($logMessage, 3, "debug.log"); // Guardar en un archivo llamado debug.log en el mismo directorio
            

                    return $e->getMessage();

                }
            }
        }
?>