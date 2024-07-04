<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/AsignEstacionamiento.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/AsignEstacionamientoRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/MySQL/MySQLSourceAsign.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/MySQLQueryMaker.php';
    class AsignEstacionamientoFactory {
        public static function createUseCase(){
            return new AsignEstacionamiento(AsignEstacionamientoFactory::createRepository());
        }
        private static function createRepository(): AsignEstacionamientoRepository{
            return new AsignEstacionamientoRepository(AsignEstacionamientoFactory::createSource());
        }
        private static function createSource(): MySQLSourceAsign{
            return new MySQLSourceAsign(AsignEstacionamientoFactory::createQueryMaker());
        }
        private static function createQueryMaker(): MySQLQueryMaker{
            return MySQLQueryMaker::getInstance();
        }
    }

?>