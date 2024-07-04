<?php

    class Comment {
        private $id;
        private $nameUser;
        private $comment;
        private $reponses = array();

        public function __construct($id, $nameUser,  $comment, $reponses){
            $this->id = $id;
            $this->nameUser = $nameUser;
            $this->comment = $comment;
            $this->reponses = $reponses;
        }

        public function getId(){
            return $this->id;
        }
        
        public function getNameUser(){
            return $this->nameUser;
        }

        public function getComment(){
            return $this->comment;
        }

        public function getResponses(){
            return $this->reponses;
        }

    }

?>