<?php
    class Reports {
        private $conn;
        public $Season;
        public $Project;


        public function __construct($db)
        {
            $this -> conn =$db;
        }

        public function getReports()
        {
            $sql = "SELECT id, Season, ProjectName, SUM(amount) AS total_amount 
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
    }
?>