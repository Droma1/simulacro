<?php
$flag_ = (!isset($_SESSION['tipo_user'])) ? 1 : 2;
if($flag_ == 1){
    include "./resourses/components/user/banner.php";
    include "./resourses/components/user/articles.php";
}else{
    //include "./resourses/components/admin/header.php";
}
?>