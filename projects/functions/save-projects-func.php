<?php
    if(isset($_POST['project_name'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Projects.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $projects = new Projects($db);
        $projects -> ProjectName = $_POST['project_name'];
        $projects -> Tonage      = $_POST['Tonage'];
        $projects -> Size        = $_POST['size'];
        $projects -> Season      = $_POST['Season'];
        $projects -> Amount      = $_POST['amount'];
        $projects -> Date        = $_POST['date'];

        $save = $projects -> createProject();

        if($save['status'] == 201){
            $_SESSION['success'] = $save['message'];
        }else{
            $_SESSION['error'] = $save['message'];
        }
        header("Location: ../index.php");
    }
?>