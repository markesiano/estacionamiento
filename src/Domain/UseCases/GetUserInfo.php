
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/estacionamiento/src/Domain/Interfaces/IGetUserInfo.php';

    class GetUserInfo implements IGetUserInfo{

        private IGetUserInfoRepository $getUserInfoRepository;

        public function __construct($getUserInfoRepository) {
            $this->getUserInfoRepository = $getUserInfoRepository;
        }

        function execute($correo) {
            try{
                if($this->getUserInfoRepository == null){
                    throw new Exception("Error: getUserInfoRepository no puede ser null");
                }
                // Retornamos un array de objetos de tipo Estacionamiento
                return $this->getUserInfoRepository->getUserData($correo);
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }


    }
?>