<?php
    if(isset($_POST['user'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Registration.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $users = new Registration($db);
        $users -> Id = $_POST['user'];

        $user  = $users -> getUser();

        echo json_encode($user);
    }
?>