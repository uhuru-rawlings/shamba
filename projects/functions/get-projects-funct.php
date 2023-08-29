<?php
    if(isset($_POST['project'])){
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Projects.php");

        $conn = new Database();
        $db   = $conn -> connection();

        $users = new Projects($db);
        $users -> Id = $_POST['project'];

        $user  = $users -> getProject();

        echo json_encode($user);
    }
?>