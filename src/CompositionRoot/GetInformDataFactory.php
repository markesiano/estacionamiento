<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/GetInformData.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/GetInformDataRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/MySQL/MySQLSourceInform.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/Mappers/GetInformDataDomainMapper.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/MySQLQueryMaker.php';
    class GetInformDataFactory {
        public static function createUseCase(){
            return new GetInformData(GetInformDataFactory::createRepository());
        }
        private static function createRepository(): GetInformDataRepository{
            return new GetInformDataRepository(GetInformDataFactory::createSource(), new GetInformDataDomainMapper());
        }
        private static function createSource(): MySQLSourceInform{
            return new MySQLSourceInform(GetInformDataFactory::createQueryMaker());
        }
        private static function createQueryMaker(): MySQLQueryMaker{
            return MySQLQueryMaker::getInstance();
        }
    }

?>