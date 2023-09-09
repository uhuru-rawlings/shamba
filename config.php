<?php
    session_start();
    date_default_timezone_set("Africa/Nairobi");
    if ($_SERVER['HTTP_HOST'] == "127.0.0.1" || $_SERVER['HTTP_HOST'] == "localhost") {
        // define('ROOT_PATH', realpath(dirname(__FILE__)));
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);

        define('BASE_URL', 'http://127.0.0.1/shamba/');

    } else {
        define('BASE_URL', 'http://opgfarm.site/');
    }

    // if(!isset($_SESSION['normaluser']) || !$_SESSION['normaluser']){
    //     $url = BASE_URL.'index.php';
    //     header("Location: {$url}");
    // }

?>
