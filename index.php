<?php
//session_start(['name'=>'UA']);

    include_once "./config/config.php";

    include_once "./routes/web.php";



    $views = new Route_controller();

    $views->index_();

?>