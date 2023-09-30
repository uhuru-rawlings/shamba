<?php
    if(isset($_POST['Amount'])){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        session_start();
        include_once("../../model/Cashflow.php");
        include_once("../../model/Registration.php");
        include_once("../../database/Database.php");

        $user = $_POST['User'];

        $conn = new Database();
        $db   = $conn -> connection();

        $cash_f = new Cashflow($db);
        $cash_f -> amount = $_POST['Amount'];

        if(empty($_POST['User']) || $_POST['User'] == ""){
            $users = new Registration($db);
            $users -> Email = $_SESSION['user_a'];
            echo $_SESSION['user_a'];
            $user = $users -> getUserProfile();
            var_dump($user);
            if($user['data']){
                $cash_f -> user = $user['data']['id'];
            }
        }else{
            $cash_f -> user = $_POST['User'];
        }

        $save = $cash_f -> saveAmount();

        if($save['status'] == 200){
            $_SESSION['success'] = $save['message'];
        }else{
            $_SESSION['error'] = $save['message'];
        }

        header("Location: ../index.php");
    }
?>