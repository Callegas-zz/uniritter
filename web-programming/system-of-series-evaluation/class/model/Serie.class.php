<?php

class Serie {
    private $serieId;
    private $serieName;
    private $serieDescribe;
    private $totalSeasons;
    private $rate;
    
    function getSerieId() {
        return $this->serieId;
    }

    function getSerieName() {
        return $this->serieName;
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

    function setSerieName($serieName) {
        $this->serieName = $serieName;
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
