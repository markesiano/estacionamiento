<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IAddComment.php';

    class AddComment implements IAddComment{

        private IAddCommentRepository $AddCommentRepository;

        public function __construct($AddCommentRepository) {
            $this->AddCommentRepository = $AddCommentRepository;
        }

        function execute($name,$comment) {
            try{
                if($this->AddCommentRepository == null){
                    throw new Exception("Error: AddCommentRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                $this->AddCommentRepository->addComment($name,$comment);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>