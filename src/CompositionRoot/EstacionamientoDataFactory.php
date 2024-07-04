<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Presentation/EstacionamientoViewModel.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/GetEstacionamientoData.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/GetEstacionamientoDataRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/MySQL/MySQLSource.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/Mappers/EstacionamientoDataDomainMapper.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/MySQLQueryMaker.php';
    class EstacionamientoDataFactory {
        public static function create(): EstacionamientoViewModel{
            return new EstacionamientoViewModel(EstacionamientoDataFactory::createUseCase());
        }
        private static function createUseCase(): GetEstacionamientoData{
            return new GetEstacionamientoData(EstacionamientoDataFactory::createRepository());
        }
        private static function createRepository(): GetEstacionamientoDataRepository{
            return new GetEstacionamientoDataRepository(EstacionamientoDataFactory::createSource(), new EstacionamientoDataDomainMapper());
        }
        private static function createSource(): MySQLSource{
            return new MySQLSource(EstacionamientoDataFactory::createQueryMaker());
        }
        private static function createQueryMaker(): MySQLQueryMaker{
            return MySQLQueryMaker::getInstance();
        }

    }   
?>