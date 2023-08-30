<?php
    if(isset($_POST['scope'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Scope.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $users = new Scope($db);
        $users -> Id = $_POST['scope'];

        $user  = $users -> getScope();

        echo json_encode($user);
    }
?>