<?php
    if(isset($_GET['project'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Projects.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $users = new Projects($db);

        $users -> Id  = $_GET['project'];

        $save = $users -> deleteProject();

        if($save['status'] == 200){
            $_SESSION['success'] = $save['message'];
            header("Location: ../index.php");
        }else{
            $_SESSION['error'] = $save['message'];
            header("Location: ../index.php");
        }
    }
?>