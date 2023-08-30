<?php
if(isset($_POST['Expense'])){
        // define('ROOT_PATH', realpath(dirname(__FILE__)));
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Expenditure.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $scope = new Expenditure($db);
        $scope -> Expense = $_POST['Expense'];
        $scope -> Id      = $_POST['updates'];

        $save = $scope -> updateExpense();

        if($save['status'] == 201){
            $_SESSION['success'] = $save['message'];
        }else{
            $_SESSION['error'] = $save['message'];
        }
        header("Location: ../index.php");
    }
?>
