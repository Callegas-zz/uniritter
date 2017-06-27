<?php

include_once "Connection.class.php";

class SerieDAO {
    private $connection;

    public function __construct() {
        $this->connection = new Connection();
        
    }

    public function getSeries() {
        try {
            $cst = $this->connection->connect()->prepare("SELECT * FROM serie");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function remove($id) {
        try {
            $cst = $this->connection->connect()->prepare("DELETE FROM serie WHERE serieId = '$id'");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function registerSerie($name, $serieDescribe, $totalSeasons) {
        try{

            $cst = $this->connection->connect()->prepare("INSERT INTO serie (serieName, serieDescribe, totalSeasons)
              VALUES ('$name', '$serieDescribe', '$totalSeasons');");   
            if($cst->execute()){
                return 'ok';
            }else{
                return 'Error ao cadastrar';
            }
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }

    }


    public function getRate($serieId) {
        try {   
            $cst = $this->connection->connect()->prepare("SELECT ROUND(AVG(rate), 1) FROM serie_rating WHERE serieId = '$serieId';");
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

}
