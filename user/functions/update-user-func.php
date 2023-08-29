<?php
    if(isset($_POST['Email'])){
        // define('ROOT_PATH', realpath(dirname(__FILE__)));
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Registration.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $users = new Registration($db);
        $users -> Id        = $_POST['updates'];
        $users -> FirstName = $_POST['Fname'];
        $users -> LastName  = $_POST['Lname'];
        $users -> Email     = $_POST['Email'];
        $users -> Phone     = $_POST['Phone'];
        $users -> Roles     = "Admin";
        $users -> Password  = $_POST['password'] ? $_POST['password'] : "";

        $save = $users -> updateUser();

        if($save['status'] == 201){
            $_SESSION['success'] = $save['message'];
            header("Location: ../index.php");
        }else{
            $_SESSION['error'] = $save['message'];
            header("Location: ../index.php");
        }
    }
?>