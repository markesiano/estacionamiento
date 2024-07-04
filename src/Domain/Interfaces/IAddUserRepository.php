<?php

    interface IAddUserRepository {
        public function addUser($nombre,$correo,$tipo,$placa): void;
    }

?>