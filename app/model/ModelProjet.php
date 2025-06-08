<?php

require_once 'Model.php';

class ModelProjet {

    private $id, $label, $responsable, $groupe;
    
    public function __construct($id, $label, $responsable, $groupe) {
        $this->id = $id;
        $this->label = $label;
        $this->responsable = $responsable;
        $this->groupe = $groupe;
    }
    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getResponsable() {
        return $this->responsable;
    }

    public function getGroupe() {
        return $this->groupe;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setLabel($label): void {
        $this->label = $label;
    }

    public function setResponsable($responsable): void {
        $this->responsable = $responsable;
    }

    public function setGroupe($groupe): void {
        $this->groupe = $groupe;
    }
    
}