<?php

require_once 'Model.php';
require_once 'ModelCreneau.php';

class ModelRdv {

    private $id, $creneau, $etudiant;

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

    public static function getRdvEtu($etu_id) {
        try {

            $database = Model::getInstance();
            $query = "SELECT creneau FROM rdv WHERE etudiant = $etu_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $creneau_id = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            if (empty($creneau_id)) {
                return []; // No creneau found, return empty array
            }

            $placeholders = implode(',', array_fill(0, count($creneau_id), '?'));

            $query = "SELECT projet, examinateur, creneau FROM creneau WHERE id IN ($placeholders)";
            $statement = $database->prepare($query);
            $statement->execute($creneau_id);

            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");

            return $creneau_id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
