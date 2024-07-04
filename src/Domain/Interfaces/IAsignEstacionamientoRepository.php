<?php
    interface IAsignEstacionamientoRepository {
        public function asignEstacionamiento($lugar,$situacion,$cliente,$automovil,$placas,$horaEntrada);
    }
?>