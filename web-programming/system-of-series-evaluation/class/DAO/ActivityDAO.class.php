<?php

include_once "Connection.class.php";

class ActivityDAO {
    private $connection;

    public function __construct() {
        $this->connection = new Connection();
        
    }

    public function getActivity($user) {
        try {
            $cst = $this->connection->connect()->prepare("SELECT * FROM serie_user WHERE userId = '$user'");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getSerieName($serieId) {
        try {
            $cst = $this->connection->connect()->prepare("SELECT serieName FROM serie WHERE serieId = '$serieId'");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getSerieId($serieName) {
        try {
            $cst = $this->connection->connect()->prepare("SELECT serieId FROM serie WHERE serieName = '$serieName'");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getCurrentUserId($user) {
        try {
            $cst = $this->connection->connect()->prepare("SELECT userId FROM user WHERE userLogin = '$user'");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }

    }

    public function registerActivity($userId, $serieId, $season, $episode) {
        try{
            $userId = $userId['userId'];
            $serieId = $serieId['serieId'];
            $cst = $this->connection->connect()->prepare("INSERT INTO serie_user (userId, serieId, currentSeason, currentEpisode)
               VALUES ('$userId', '$serieId', '$season', '$episode');");   
            if($cst->execute()){
                return 'ok';
            }else{
                return 'Error ao cadastrar';
            }
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }

    }

}
