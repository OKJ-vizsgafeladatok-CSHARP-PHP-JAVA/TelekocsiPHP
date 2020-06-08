<?php

class Igeny {

    private $azonosito;
    private $indulas;
    private $cel;
    private $szemelyek;
    
    function __construct($azonosito, $indulas, $cel, $szemelyek) {
        $this->azonosito = $azonosito;
        $this->indulas = $indulas;
        $this->cel = $cel;
        $this->szemelyek = $szemelyek;
    }
    function getAzonosito() {
        return $this->azonosito;
    }

    function getIndulas() {
        return $this->indulas;
    }

    function getCel() {
        return $this->cel;
    }

    function getSzemelyek() {
        return $this->szemelyek;
    }

    function setAzonosito($azonosito): void {
        $this->azonosito = $azonosito;
    }

    function setIndulas($indulas): void {
        $this->indulas = $indulas;
    }

    function setCel($cel): void {
        $this->cel = $cel;
    }

    function setSzemelyek($szemelyek): void {
        $this->szemelyek = $szemelyek;
    }


}
