<?php
    class Scope {
        private $conn;
        public  $Project;
        public  $Season;
        public  $Id;
        public  $Year;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function saveScope()
        {
            $sql = "SELECT * FROM Scope WHERE Project = ? AND Season = ? AND `Year` = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Project, $this -> Season, $this -> Year]);

            if($query -> rowCount() > 0){
                return ['status' => 300, 'message' => 'project already exist'];
            }else{
                $sql = "INSERT INTO Scope(`Project`,`Season`,`Year`) VALUES(?,?,?)";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Project, $this -> Season, $this -> Year]);

                if($query){
                    return ['status' => 201, 'message' => 'project created successfully'];
                }else{
                    return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
                }
            }
        }

        public function getScopes()
        {
            $sql = "SELECT * FROM Scope";
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

        public function getDistinctProjectScopes()
        {
            $sql = "SELECT DISTINCT Project FROM Scope";
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
        public function getDistinctSeasonScopes()
        {
            $sql = "SELECT DISTINCT Season FROM Scope";
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

        public function getScope()
        {
            $sql = "SELECT * FROM Scope WHERE id = ?";
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

        public function updateScope()
        {
            $sql = "SELECT * FROM Scope WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                $sql = "UPDATE Scope SET `Project` = ?,`Season` = ?,`Year` = ? WHERE id = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Project, $this -> Season, $this -> Year, $this -> Id]);

                if($query){
                    return ['status' => 201, 'message' => 'scope updated successfully'];
                }else{
                    return ['status' => 500, 'message' => 'Oops! something went wrong, try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'scope do not exist'];
            }
        }

        public function deleteScope()
        {
            $sql = "SELECT * FROM Scope WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                $sql = "DELETE FROM Scope WHERE id = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Id]);
                if($query){
                    return ['status' => 200, 'message' => 'scope record deleted successfully'];
                }else{
                    return ['status' => 403, 'message' => 'Oops! something went wrong, please try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'scope not found'];
            }
        }
    }
?>