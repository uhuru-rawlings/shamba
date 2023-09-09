<?php
    class Reports {
        private $conn;
        public $Season;
        public $Project;
        public $projectName;
        public $Expenditure;
        public $Year;


        public function __construct($db)
        {
            $this -> conn =$db;
        }

        public function getReports()
        {
            $sql = "SELECT id, Season, ProjectName, Expense, SUM(amount) AS total_amount 
            FROM Projects
            GROUP BY Season, ProjectName";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();


            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No projects found'];
            }
        }

        public function searchReports()
        {
            $sql = "SELECT * FROM Projects WHERE 1=1";

            // Initialize an array to store the values for binding
            $values = array();
            
            if (!empty($this->Year)) {
                // $sql .= " AND ProjectName = ?";
                // $values[] = $this->Year;
                $sql .= " AND YEAR(DateAdded) = ?";
                $values[] = $this -> Year;
            }

            if (!empty($this->projectName)) {
                $sql .= " AND ProjectName = ?";
                $values[] = $this->projectName;
            }
            
            if (!empty($this->Season)) {
                $sql .= " AND Season = ?";
                $values[] = $this->Season;
            }
            
            if (!empty($this->Expenditure)) {
                $sql .= " AND Expense = ?";
                $values[] = $this->Expenditure;
            }
            
            $query = $this->conn->prepare($sql);
            $query->execute($values);

            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No projects found'];
            }
        }

        public function getReportDetails()
        {
            $sql = "SELECT * FROM Projects  WHERE ProjectName = ? AND Season = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Project, $this -> Season]);


            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No projects found'];
            }
        }

        public function usersCount(){
            $sql = "SELECT * FROM Registration";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            return $query -> rowCount();
        }

        public function projectsCount(){
            $sql = "SELECT * FROM Scope";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            return $query -> rowCount();
        }

        public function expenseCount(){
            $sql = "SELECT * FROM Expenditure";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            return $query -> rowCount();
        }

        public function expenseTotal(){
            $sql = "SELECT * FROM Projects";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            $total = 0;
            if($query -> rowCount() > 0){
                while($res = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    foreach($res as $res){
                        $total += $res['Amount'];
                    }
                }
            }
            return $total;
        }
    }
?>