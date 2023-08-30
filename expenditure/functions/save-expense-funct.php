<?php
    if(isset($_POST['Expense'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Expenditure.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $scope = new Expenditure($db);
        $scope -> Expense = $_POST['Expense'];

        $save = $scope -> saveExpense();

        if($save['status'] == 201){
            $_SESSION['success'] = $save['message'];
        }else{
            $_SESSION['error'] = $save['message'];
        }
        header("Location: ../index.php");
    }
?>