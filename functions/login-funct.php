<?php
    if(isset($_POST['username'])){
        session_start();
        include_once("../model/Registration.php");
        include_once("../database/Database.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $user = new Registration($db);
        $user -> Email    = $_POST['username'];
        $user -> Password = $_POST['password'];

        $save = $user -> loginUser();

        if($save['status'] == 200 || $save['status'] == 201){
            $_SESSION['success'] = $save['message'];
            $_SESSION['u_name'] = $save['user'];
            $_SESSION['user_a'] = $_POST['username'];
            header("Location: ../dashboard/index.php");
        }else{
            $_SESSION['error'] = $save['message'];
            header("Location: ../index.php");
        }
    }
?>