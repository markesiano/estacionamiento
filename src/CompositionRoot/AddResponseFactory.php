<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/AddResponse.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/AddResponseRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/txt/SecuencialSourceResponse.php';
    class AddResponseFactory {
        public static function createUseCase(){
            return new AddResponse(AddResponseFactory::createRepository());
        }
        private static function createRepository(): AddResponseRepository{
            return new AddResponseRepository(AddResponseFactory::createSource());
        }
        private static function createSource(): SecuencialSourceResponse{
            return new SecuencialSourceResponse();
        }
    }

?>