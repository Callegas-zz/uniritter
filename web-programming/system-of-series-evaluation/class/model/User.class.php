<?php

class User {
    private $userId;
    private $name;
    private $login;
    private $password;
       
    function getUserId() {
        return $this->userId;
    }

    function getName() {
        return $this->name;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

   
}
