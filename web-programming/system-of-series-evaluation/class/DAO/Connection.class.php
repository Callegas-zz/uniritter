<?php



class Connection {
    private $user = "";
    private $password = "";
    private $path = "";
    private $dataBase = "";
    private $connection = "";
    private $errorMessage = "Connection to database failed";
    
    private function __construct() {
        $this->connection = mysqli_connect($this->path, $this->user, $this->password) or die ($this->errorMessage);
        mysqli_select_db($this->connection, $this->path) or die ($this->errorMessage);
    }
    
    public function getConnection(){
        return $this->connection;
    }
}
