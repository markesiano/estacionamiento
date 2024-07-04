<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/GetComments.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/GetCommentsRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/txt/SecuencialSource.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/Mappers/GetCommentsDomainMapper.php';
    class GetCommentsFactory {
        public static function createUseCase(){
            return new GetComments(GetCommentsFactory::createRepository());
        }
        private static function createRepository(): GetCommentsRepository{
            return new GetCommentsRepository(GetCommentsFactory::createSource(), new GetCommentsDomainMapper());
        }
        private static function createSource(): SecuencialSource{
            return new SecuencialSource();
        }
    }

?>