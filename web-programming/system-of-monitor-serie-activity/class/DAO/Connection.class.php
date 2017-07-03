<?php

class Connection{

	private $user;
	private $password;
	private $dataBase;
	private $path;
	private static $pdo;

	public function __construct(){
        $this->user = "root";
        $this->password = "";
        $this->dataBase = "web2";
		$this->path = "localhost";
	}

	public function connect(){
		try{
			if(is_null(self::$pdo)){
				self::$pdo = new PDO("mysql:host=".$this->path.";dbname=".$this->dataBase, $this->user, $this->password);
			}
			return self::$pdo;
		}catch(PDOException $e){
			echo 'Error: '.$e->getMessage();
		}
	}
}
