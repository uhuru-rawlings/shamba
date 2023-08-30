<?php
    class Expenditure {
        private $conn;
        public  $Expense;
        public  $Id;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function saveExpense()
        {
            $sql = "SELECT * FROM Expenditure WHERE Expense = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Expense]);

            if($query -> rowCount() > 0){
                return ['status' => 300, 'message' => 'Expense already exist'];
            }else{
                $sql = "INSERT INTO Expenditure(`Expense`) VALUES(?)";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Expense]);

                if($query){
                    return ['status' => 201, 'message' => 'expense created successfully'];
                }else{
                    return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
                }
            }
        }

        public function getExpenses()
        {
            $sql = "SELECT * FROM Expenditure";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            if($query){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
            }
        }

        public function getExpense()
        {
            $sql = "SELECT * FROM Expenditure WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return ['status' => 201, 'data' => $results];
                }
            }else{
                return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
            }
        }

        public function updateExpense()
        {
            $sql = "SELECT * FROM Expenditure WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                $sql = "UPDATE Expenditure SET `Expense` = ? WHERE id = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Expense, $this -> Id]);

                if($query){
                    return ['status' => 201, 'message' => 'expenditure updated successfully'];
                }else{
                    return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'expenditure do not exist'];
            }
        }

        public function deleteExpense()
        {
            $sql = "SELECT * FROM Expenditure WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                $sql = "DELETE FROM Expenditure WHERE id = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Id]);
                if($query){
                    return ['status' => 200, 'message' => 'user record deleted successfully'];
                }else{
                    return ['status' => 403, 'message' => 'Oops! something went wrong, please try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'expenditure not found'];
            }
        }
    }
?>