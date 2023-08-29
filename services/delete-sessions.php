<?php
    if(isset($_POST['name'])){
        session_start();
        $_SESSION['success'] = "";
        $_SESSION['error'] = "";
        
        unset($_SESSION['success']);
        unset($_SESSION['error']);
    }
?>