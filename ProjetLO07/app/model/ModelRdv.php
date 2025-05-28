<?php

require_once 'Model.php';

class ModelRdv {
    private $id,$creneau,$etudiant;
    
    public function __construct($id, $creneau, $etudiant) {
        $this->id = $id;
        $this->creneau = $creneau;
        $this->etudiant = $etudiant;
    }
    public function getId() {
        return $this->id;
    }

    public function getCreneau() {
        return $this->creneau;
    }

    public function getEtudiant() {
        return $this->etudiant;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setCreneau($creneau): void {
        $this->creneau = $creneau;
    }

    public function setEtudiant($etudiant): void {
        $this->etudiant = $etudiant;
    }



}
