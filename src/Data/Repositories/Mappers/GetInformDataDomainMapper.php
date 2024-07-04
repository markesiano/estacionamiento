<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Entities/Informe.php';

class GetInformDataDomainMapper {
    public function map($results) {
        $informes = array();

        foreach ($results as $result) {
            $lugar = $result['lugar'];

            // Convertir de string separados por comas a array
            $listaCarrosEstacionados = explode(", ", $result['automoviles']);
            

            // Convertir a formato 00:00:00

            $tiempoOcupacion = gmdate("H:i:s", $result['tiempo_total_usado']);

            $nCarrosEstacionados = $result['numero_automoviles'];

            $informe = new Informe($lugar, $listaCarrosEstacionados, $tiempoOcupacion, $nCarrosEstacionados);
            $informes[] = $informe;
        }

        return $informes;
    }
}
?>

