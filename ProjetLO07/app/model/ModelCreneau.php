<?php

require_once 'Model.php';

class ModelCreneau {

    private $id, $projet, $examinateur, $creneau;
    public function __construct($id, $projet, $examinateur, $creneau) {
        $this->id = $id;
        $this->projet = $projet;
        $this->examinateur = $examinateur;
        $this->creneau = $creneau;
    }
    public function getId() {
        return $this->id;
    }

    public function getProjet() {
        return $this->projet;
    }

    public function getExaminateur() {
        return $this->examinateur;
    }

    public function getCreneau() {
        return $this->creneau;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setProjet($projet): void {
        $this->projet = $projet;
    }

    public function setExaminateur($examinateur): void {
        $this->examinateur = $examinateur;
    }

    public function setCreneau($creneau): void {
        $this->creneau = $creneau;
    }


    
}