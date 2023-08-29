<?php
    if(isset($_GET['user'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Registration.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $users = new Registration($db);

        $users -> Id  = $_GET['user'];

        $save = $users -> deleteUser();

        if($save['status'] == 200){
            $_SESSION['success'] = $save['message'];
            header("Location: ../index.php");
        }else{
            $_SESSION['error'] = $save['message'];
            header("Location: ../index.php");
        }
    }
?>