<?php
    session_start();
    if(isset($_SESSION['user_a'])){
        unset($_SESSION['user_a']);
        $_SESSION['success'] = "you have logged out successfully";
        header("Location: index.php");
    }
?>