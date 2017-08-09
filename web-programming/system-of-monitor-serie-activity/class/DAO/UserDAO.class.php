<?php

include_once "Connection.class.php";

class UserDAO {
  private $connection;

  public function __construct() {
    $this->connection = new Connection();
  }

  public function login($password, $login) {
    try {
      $cst = $this->connection->connect()->prepare("SELECT * FROM user WHERE userLogin = '$login' AND userPassword = '$password'");
      $cst->execute();
      return $cst->fetchAll();
    }catch (PDOException $e) {
      return 'Error: ' . $e->getMessage();
    }
  }


}
