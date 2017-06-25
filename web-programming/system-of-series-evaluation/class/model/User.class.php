<?php

class User {
    private $userId;
    private $name;
    private $login;
    private $password;
    private $logged;
    
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

    function getLogged() {
        return $this->logged;
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

    function setLogged($logged) {
        $this->logged = $logged;
    }


}
