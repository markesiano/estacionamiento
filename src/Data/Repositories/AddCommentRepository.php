<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAddCommentRepository.php';
    class AddCommentRepository implements IAddCommentRepository {

        private $database;

        public function __construct($database){
            $this->database = $database;
        }

        public function addComment($name, $comment)
        {
            try{
                $this->database->addComment($name, $comment);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }


?>