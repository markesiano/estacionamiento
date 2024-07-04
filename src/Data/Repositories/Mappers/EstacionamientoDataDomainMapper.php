<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Entities/Estacionamiento.php';
    class EstacionamientoDataDomainMapper {
        public function map($result){
            $lugares = array();
            // Mapeamos los resultados de $result derivados de la consulta a la base de datos y los asignamos a un array de objetos de la clase Estacionamiento
            while($row = $result->fetch_assoc()){
                $lugar = new Estacionamiento($row['lugar'], $row['situacion'], $row['cliente'], $row['automovil'], $row['placas'], $row['horaEntrada'], $row['horaSalida']);
                array_push($lugares, $lugar);
            }
            return $lugares;
        }
    }

?>