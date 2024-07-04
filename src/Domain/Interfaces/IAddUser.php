<?php
interface IAddUser
{
    public function execute($nombre,$correo,$tipo,$placa): void;
}
?>