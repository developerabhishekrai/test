<?php
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    require(APP_PATH.'config/helper.php');

    if (isset($_SESSION['authority'])) {
        session_destroy();
        redirect('Authority/index');
    }else {
        redirect('Authority/index');
    }
?>