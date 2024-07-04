<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/AddComment.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/AddCommentRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/txt/SecuencialSourceAdd.php';
    class AddCommentFactory {
        public static function createUseCase(){
            return new AddComment(AddCommentFactory::createRepository());
        }
        private static function createRepository(): AddCommentRepository{
            return new AddCommentRepository(AddCommentFactory::createSource());
        }
        private static function createSource(): SecuencialSourceAdd{
            return new SecuencialSourceAdd();
        }
    }

?>