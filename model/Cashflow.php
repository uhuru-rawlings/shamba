<?php
    class Cashflow {
        private $conn;
        public $user;
        public $amount;
        public $id;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function saveAmount()
        {
            $sql = "INSERT INTO Cashflow(User,Amount) VALUES(?,?)";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> user, $this -> amount]);

            if($query){
                return ['status' => 200, 'message' => 'cashflow detail saved successfully.'];
            }else{
                return ['status' => 500, 'message' => 'something went wrong, please try again.'];
            }
        }

        public function getCashFlow()
        {
            $sql = "SELECT Cashflow.*,Registration.* FROM Cashflow JOIN Registration ON Cashflow.User = Registration.id";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No data found'];
            }
        }

        public function getAllAmount()
        {
            $sql = "SELECT * FROM Cashflow";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No data found'];
            }
        }

        public function getUSerAmount()
        {
            $sql = "SELECT * FROM Cashflow WHERE User = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> user]);

            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No data found'];
            }
        }

        public function reduceAmount()
        {
            $sql = "UPDATE Cashflow SET Amount = ? WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> amount, $this -> id]);
        }
    }
?>