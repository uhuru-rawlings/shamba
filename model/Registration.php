<?php
    class Registration {
        public $FirstName;
        public $LastName;
        public $Email;
        public $Phone;
        public $Roles;
        public $Password;
        public $Id;
        private $conn;

        public function __construct($db)
        {
            $this -> conn = $db;
        }

        public function getUsers()
        {
            $sql = "SELECT * FROM Registration";
            $query = $this -> conn -> prepare($sql);
            $query -> execute();

            if($query -> rowCount() > 0){
                while($results = $query -> fetchAll(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'users not found'];
            }
        }

        public function getUser()
        {
            $sql = "SELECT * FROM Registration WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'users not found'];
            }
        }

        public function getUserProfile()
        {
            $sql = "SELECT * FROM Registration WHERE Email = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Email]);

            if($query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    return ['status' => 200, 'data' => $results];
                }
            }else{
                return ['status' => 404, 'message' => 'users not found'];
            }
        }

        public function signUp()
        {
            $sql = "SELECT * FROM Registration WHERE Email = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Email]);

            if($query -> rowCount() > 0){
                return ['status' => 404, 'message' => 'User with these credentials already exist.'];
            }else{
                $sql = "INSERT INTO Registration(`Fname`, `Lname`, `Email`, `Phone`, `Roles`, `Password`) VALUES(?,?,?,?,?,?)";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> FirstName, $this -> LastName, $this -> Email, $this -> Phone, $this -> Roles, password_hash($this -> Password, PASSWORD_DEFAULT)]);

                if($query){
                    return  ['status' => 201, 'message' => 'user created successfully'];
                }else{
                    return  ['status' => 500, 'message' => 'Oops! something went wrong, please try again'];
                }
            }
        }

        public function updateUser()
        {
            $sql = "SELECT * FROM Registration WHERE Email = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Email]);

            if($query -> rowCount() > 0){
                if($this -> Password == ""){
                    $sql = "UPDATE Registration SET `Fname` = ?, `Lname` = ?, `Email` = ?, `Phone` = ?, `Roles` = ? WHERE id = ?";
                    $query = $this -> conn -> prepare($sql);
                    $query -> execute([$this -> FirstName, $this -> LastName, $this -> Email, $this -> Phone, $this -> Roles, $this -> Id]);
                }else{
                    $sql = "UPDATE Registration SET `Fname` = ?, `Lname` = ?, `Email` = ?, `Phone` = ?, `Roles` = ?, `Password` = ? WHERE id = ?";
                    $query = $this -> conn -> prepare($sql);
                    $query -> execute([$this -> FirstName, $this -> LastName, $this -> Email, $this -> Phone, $this -> Roles, password_hash($this -> Password, PASSWORD_DEFAULT)], $this -> Id);
                }

                if($query){
                    return  ['status' => 201, 'message' => 'user created successfully'];
                }else{
                    return  ['status' => 500, 'message' => 'Oops! something went wrong, please try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'User with these credentials already exist.'];
            }
        }

        public function loginUser()
        {
            $sql = "SELECT * FROM Registration WHERE Email = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Email]);

            if($query -> rowCount() > 0){
                while($results = $query -> fetch(PDO::FETCH_ASSOC)){
                    if(password_verify($this -> Password,$results['Password'])){
                        return ['status' => 200, 'message' => 'login was successful, welcome', 'user' => $results['Fname']];
                    }else{
                        return ['status' => 403, 'message' => 'Wrong password, please try again'];
                    }
                }
            }else{
                return ['status' => 404, 'message' => 'user not found'];
            }
        }

        public function resetPassword()
        {
            $sql = "SELECT * FROM Registration WHERE Email = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Email]);

            if($query -> rowCount() > 0){
                $sql = "UPDATE TABLE Registration SET `Password` = ? WHERE Email = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([password_hash($this -> Password, PASSWORD_DEFAULT),$this -> Email]);
                if($query){
                    return ['status' => 200, 'message' => 'password was reset successfully'];
                }else{
                    return ['status' => 403, 'message' => 'Oops! something went wrong, please try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'user not found'];
            }
        }

        public function deleteUser()
        {
            $sql = "SELECT * FROM Registration WHERE id = ?";
            $query = $this -> conn -> prepare($sql);
            $query -> execute([$this -> Id]);

            if($query -> rowCount() > 0){
                $sql = "DELETE FROM Registration WHERE id = ?";
                $query = $this -> conn -> prepare($sql);
                $query -> execute([$this -> Id]);
                if($query){
                    return ['status' => 200, 'message' => 'user record deleted successfully'];
                }else{
                    return ['status' => 403, 'message' => 'Oops! something went wrong, please try again'];
                }
            }else{
                return ['status' => 404, 'message' => 'user not found'];
            }
        }
        
    }
?>