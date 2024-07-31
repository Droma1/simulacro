<?php
//session_start(['name'=>'UA']);

    include_once "./config/config.php";

    include_once "./routes/web.php";

    include_once "./error_handler.php";


    $views = new Route_controller();

    $views->index_();

?>