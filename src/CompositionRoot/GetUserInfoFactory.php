<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/GetUserInfo.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/GetUserInfoRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/MySQL/MySQLSourceGet.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/Mappers/GetUserInfoDomainMapper.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/MySQLQueryMaker.php';
    class GetUserInfoFactory {
        public static function createUseCase(){
            return new GetUserInfo(GetUserInfoFactory::createRepository());
        }
        private static function createRepository(): GetUserInfoRepository{
            return new GetUserInfoRepository(GetUserInfoFactory::createSource(), new GetUserInfoDataDomainMapper());
        }
        private static function createSource(): MySQLSourceGet{
            return new MySQLSourceGet(GetUserInfoFactory::createQueryMaker());
        }
        private static function createQueryMaker(): MySQLQueryMaker{
            return MySQLQueryMaker::getInstance();
        }
    }

?>