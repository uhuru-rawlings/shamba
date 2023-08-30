<?php
    if(isset($_POST['project_name'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Scope.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $scope = new Scope($db);
        $scope -> Project = $_POST['project_name'];
        $scope -> Season  = $_POST['Tonage'];
        $scope -> Year    = $_POST['size'];

        $save = $scope -> saveScope();

        if($save['status'] == 201){
            $_SESSION['success'] = $save['message'];
        }else{
            $_SESSION['error'] = $save['message'];
        }
        header("Location: ../index.php");
    }
?>