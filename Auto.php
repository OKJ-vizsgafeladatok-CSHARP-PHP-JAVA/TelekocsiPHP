<?php

class Auto {

    private $indulas;
    private $cel;
    private $rendszam;
    private $telefonszam;
    private $ferohely;

    function __construct($indulas, $cel, $rendszam, $telefonszam, $ferohely) {
        $this->indulas = $indulas;
        $this->cel = $cel;
        $this->rendszam = $rendszam;
        $this->telefonszam = $telefonszam;
        $this->ferohely = $ferohely;
    }
    function getIndulas() {
        return $this->indulas;
    }

    function getCel() {
        return $this->cel;
    }

    function getRendszam() {
        return $this->rendszam;
    }

    function getTelefonszam() {
        return $this->telefonszam;
    }

    function getFerohely() {
        return $this->ferohely;
    }

    function setIndulas($indulas): void {
        $this->indulas = $indulas;
    }

    function setCel($cel): void {
        $this->cel = $cel;
    }

    function setRendszam($rendszam): void {
        $this->rendszam = $rendszam;
    }

    function setTelefonszam($telefonszam): void {
        $this->telefonszam = $telefonszam;
    }

    function setFerohely($ferohely): void {
        $this->ferohely = $ferohely;
    }


}
