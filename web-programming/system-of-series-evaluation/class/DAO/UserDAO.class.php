<?php

class UserDAO {
    private $connection;
    
    public function __construct() {
        $this->connection = new Connection();
    }
    
    public function login($password, $login) {
        $sql = "SELECT * FROM user WHERE userLogin = '$login' AND userPassword = '$password'";
        $execute = mysqli_query($this->connection->getConnection(), $sql);
        
        if (mysqli_num_rows($execute) > 0) {
            return true;
        }else {
            return false;
        }   
    }
    
    
}
