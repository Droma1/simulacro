<?php
if($peticionAjax){

    require_once "../../app/Model/logModel.php";

}else{

    require_once "./app/Model/logModel.php";

}

class logController extends logModel{
    
}

?>