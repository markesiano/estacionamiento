<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Interfaces/IDatabaseSourceInform.php';

class MySQLSourceInform implements IDatabaseSourceInform {
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function getData($fecha){
        $query = "SELECT lugar,
                         COUNT(automovil) AS numero_automoviles,
                         SUM(TIME_TO_SEC(TIMEDIFF(horaSalida, horaEntrada))) AS tiempo_total_usado,
                         GROUP_CONCAT(CONCAT(automovil, ' (', placas, ')') SEPARATOR ', ') AS automoviles
                  FROM estacionamiento
                  WHERE fecha = '$fecha'
                  GROUP BY lugar";
    
        $result = $this->connection->makeDBConsult($query);
        return $result;
    }
    
}
?>


