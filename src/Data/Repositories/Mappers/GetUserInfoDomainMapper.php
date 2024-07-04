<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Entities/User.php';
    class GetUserInfoDataDomainMapper {
        public function map($result){
            // Como sabemos que solo habrá un resultado, no es necesario hacer un ciclo, asi que solo mapeamos el primer resultado a un objeto de tipo User

            $resultArray = $result->fetch_assoc();
            $user = new User($resultArray['nombre'], $resultArray['correo'], $resultArray['tipo'], $resultArray['placa']);
            return $user;

        }
    }

?>