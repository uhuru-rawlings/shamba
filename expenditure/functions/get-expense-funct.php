<?php
    if(isset($_POST['expense'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Expenditure.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $users = new Expenditure($db);
        $users -> Id = $_POST['expense'];

        $user  = $users -> getExpense();

        echo json_encode($user);
    }
?>