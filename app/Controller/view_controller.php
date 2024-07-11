<?php
    require_once "./app/Model/view_model.php";
    class viewProcess extends viewModel{
        public function index():string
        {
            return require_once "./resourses/home.php";
        }

        public function view_Process($Dir):string
        {
            if(isset($_GET['page'])){
                $ruta = explode("/",$_GET['page']);//https://profile_droma.test/inicio
                $resp = parent::view_Model($Dir,$ruta[0]);
            }else{
                $resp = "home";
            }
            return $resp;
        }
    }
?>