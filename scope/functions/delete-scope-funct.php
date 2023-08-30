<?php
    if(isset($_GET['scope'])){
        // define('ROOT_PATH', realpath(dirname(__FILE__)));
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Scope.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $scope = new Scope($db);
        $scope -> Id = $_GET['scope'];

        $save = $scope -> deleteScope();

        if($save['status'] == 200){
            $_SESSION['success'] = $save['message'];
        }else{
            $_SESSION['error'] = $save['message'];
        }
        header("Location: ../index.php");
    }
?>