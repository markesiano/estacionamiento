<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/UseCases/AddUser.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Repositories/AddUserRepository.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Data/Database/MySQL/MySQLSourceAdd.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Infraestructure/Database/MySQLQueryMaker.php';
    class AddUserFactory {

        public static function createUseCase(){
            return new AddUser(AddUserFactory::createRepository());
        }
        private static function createRepository(): AddUserRepository{
            return new AddUserRepository(AddUserFactory::createSource());
        }
        private static function createSource(): MySQLSourceAdd{
            return new MySQLSourceAdd(AddUserFactory::createQueryMaker());
        }
        private static function createQueryMaker(): MySQLQueryMaker{
            return MySQLQueryMaker::getInstance();
        }

    }   
?>