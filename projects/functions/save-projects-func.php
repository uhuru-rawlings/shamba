<?php
    if(isset($_POST['project_name'])){
        define('ROOT_PATH', realpath(dirname(__FILE__)));
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        session_start();
        include_once("../../database/Database.php");
        include_once("../../model/Projects.php");
        include_once("../../model/Cashflow.php");

        $conn = new Database();
        $db   = $conn -> connection();

        // get cashflow
        $users = new Cashflow($db);
        $users -> user = $_POST['User'];
        $user  = $users -> getUSerAmount();

        $old_amount = 0;
        $new_amount = 0;
        $target_id;
        $reduce = [];
        $reduced = false;

        if($user['status'] == 200){
            foreach($user['data'] as $cost){
                $target_id = $cost['id'];
                $old_amount = $cost['Amount'];

                if($old_amount >= $_POST['amount']){
                    $new_amount = $old_amount - $_POST['amount'];
                    array_push($reduce, $cost['id']);
                    $reduced = true;
                    break;
                }else{
                    $old_amount +=  $cost['Amount'];
                    array_push($reduce, $cost['id']);
                }
            }

            // reduce amount
            if($reduced == true){
                for($i = 0; $i < count($reduce); $i++){
                    if($i == (count($reduce) - 1)){
                        $users -> amount = $new_amount;
                    }else{
                        $users -> amount = 0;
                    }
                    $users -> id     = $reduce[$i];
                    $r_amount = $users -> reduceAmount();
                }
            }else{
                $_SESSION['error'] = "user don't have enough funds";
                header("Location: ../index.php");
            }
        }
        $projects = new Projects($db);
        $projects -> ProjectName = $_POST['project_name'];
        // $projects -> Tonage      = $_POST['Tonage'];
        // $projects -> Size        = $_POST['size'];
        $projects -> Expense     = $_POST['expenditure'];
        $projects -> Season      = $_POST['Season'];
        $projects -> Amount      = $_POST['amount'];
        $projects -> Date        = $_POST['date'];

        $save = $projects -> createProject();

        if($save['status'] == 201){
            $_SESSION['success'] = $save['message'];
        }else{
            $_SESSION['error'] = $save['message'];
        }
        header("Location: ../index.php");
    }
?>