<?php

class Serie {
    private $serieId;
    private $name;
    private $serieDescribe;
    private $totalSeasons;
    private $rate;
    
    function getSerieId() {
        return $this->serieId;
    }

    function getName() {
        return $this->name;
    }

    function getSerieDescribe() {
        return $this->serieDescribe;
    }

    function getTotalSeasons() {
        return $this->totalSeasons;
    }

    function getRate() {
        return $this->rate;
    }

    function setSerieId($serieId) {
        $this->serieId = $serieId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSerieDescribe($serieDescribe) {
        $this->serieDescribe = $serieDescribe;
    }

    function setTotalSeasons($totalSeasons) {
        $this->totalSeasons = $totalSeasons;
    }

    function setRate($rate) {
        $this->rate = $rate;
    }



}
