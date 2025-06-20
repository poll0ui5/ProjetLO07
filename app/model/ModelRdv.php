<?php

require_once 'Model.php';

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

        // On récupère directement toutes les infos du rdv de cet étudiant via la vue
        $query = "SELECT * FROM infordv WHERE etudiant_id = :etu_id";
        $statement = $database->prepare($query);
        $statement->bindParam(':etu_id', $etu_id, PDO::PARAM_INT);
        $statement->execute();

        // Tu peux choisir le format
        $rdvInfos = $statement->fetchAll(PDO::FETCH_ASSOC);
        // ou : $rdvInfos = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRdv");

        return $rdvInfos;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return NULL;
    }
}
public static function getCreneauxDispo($projet_id) {
    try {
        $database = Model::getInstance();
        $query = "
            SELECT CR.id, CR.creneau, EX.nom as examinateur_nom, EX.prenom as examinateur_prenom
            FROM creneau CR
            JOIN personne EX ON CR.examinateur = EX.id
            LEFT JOIN rdv R ON CR.id = R.creneau
            WHERE CR.projet = :projet_id AND R.id IS NULL
        ";

        $statement = $database->prepare($query);
        $statement->bindParam(':projet_id', $projet_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return NULL;
    }
}


}
