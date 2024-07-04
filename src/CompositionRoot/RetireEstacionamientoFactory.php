<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/RetireEstacionamiento.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/RetireEstacionamientoRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/MySQL/MySQLSourceRetire.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/MySQLQueryMaker.php';
    class RetireEstacionamientoFactory {

        public static function createUseCase(){
            return new RetireEstacionamiento(RetireEstacionamientoFactory::createRepository());
        }
        private static function createRepository(): RetireEstacionamientoRepository{
            return new RetireEstacionamientoRepository(RetireEstacionamientoFactory::createSource());
        }
        private static function createSource(): MySQLSourceRetire{
            return new MySQLSourceRetire(RetireEstacionamientoFactory::createQueryMaker());
        }
        private static function createQueryMaker(): MySQLQueryMaker{
            return MySQLQueryMaker::getInstance();
        }

    }   
?>