<?php
    class Projects {
        public $ProjectName;
        public $Id;
        public $Tonage;
        public $Size;
        public $Season;
        public $Amount;
        public $Expense;
        public $Date;
        private $conn;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function createProject()
        {
            $sql = "INSERT INTO Projects(`ProjectName`,`Season`,`Expense`,`Amount`,`Date`) VALUES(?,?,?,?,?)";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> ProjectName, $this -> Season, $this -> Expense, $this -> Amount, $this -> Date]);

            if($query){
                return ['status' => 201, 'message' => 'project created successfully'];
            }else{
                return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
            }
        }

        public function updateProject()
        {
            $sql = "UPDATE Projects SET `ProjectName` = ?,`Season` = ?, `Expense` = ?,`Amount` = ?,`Date` = ? WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> ProjectName, $this -> Season, $this -> Expense, $this -> Amount, $this -> Date, $this -> Id]);

            if($query){
                return ['status' => 201, 'message' => 'project created successfully'];
            }else{
                return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
            }
        }

        public function getProjects()
        {
            $sql = "SELECT * FROM Projects ORDER BY id DESC";
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

        public function getProject()
        {
            $sql = "SELECT * FROM Projects WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No projects found'];
            }
        }

        public function getProjectBySeasonPerYear()
        {
            $sql = "SELECT * FROM Projects WHERE Season = ? AND YEAR(`Date`) = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Season, $this -> Date]);

            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No projects found'];
            }
        }

        public function getProjectByProjectName()
        {
            $sql = "SELECT * FROM Projects WHERE ProjectName = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> ProjectName]);

            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'No projects found'];
            }
        }

        public function deleteProject()
        {
            $sql = "SELECT * FROM Projects WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                $sql = "DELETE FROM Projects WHERE id = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Id]);
                if($query){
                    return ['status' => 200, 'message' => 'project record deleted successfully'];
                }else{
                    return ['status' => 403, 'message' => 'Oops! something went wrong, please try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'Project not found'];
            }
        }
    }

    $body = "<div>
                <p>New message from:-</p>
                <p>Full Name: {$_POST['fname']}</p>
                <p>Email: {$_POST['email']}</p>
                <p>Phone: {$_POST['phone']}</p>
                <p>{$_POST['message']}</p>
            </div>";
?>