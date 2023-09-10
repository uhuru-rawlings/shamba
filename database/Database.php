<?php
    class Database {
        private $db_host;
        private $db_user;
        private $db_password;
        private $db_name;
        private $conn;


        public function __construct()
        {

            if ($_SERVER['HTTP_HOST'] == "127.0.0.1" || $_SERVER['HTTP_HOST'] == "localhost") {

                $this -> db_host     = "127.0.0.1";
                $this -> db_user     = "root";
                $this -> db_password = "";
                $this -> db_name     = "Shamba";
        
            } else {
                $this -> db_host     = "127.0.0.1";
                $this -> db_user     = "opgfarm_opgfarm";
                $this -> db_password = "z&fYP=!Eg2X]";
                $this -> db_name     = "opgfarm_opgfarm";
            }        
        }

        public function connection()
        {
            $sql = "mysql:host=".$this -> db_host.";dbname=".$this -> db_name;
            $db = new PDO($sql,$this -> db_user,$this -> db_password);
            if($db){
                $this -> conn = $db;
                return $this -> conn;
            }else{
                return false;
            }
        }
    }
?>