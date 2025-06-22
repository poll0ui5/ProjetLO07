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

            // On récupère les infos via la vue infordv pour avoir un affichage complet
            $query = "SELECT * FROM infordv WHERE etudiant_id = :etu_id";
            $statement = $database->prepare($query);
            $statement->bindParam(':etu_id', $etu_id, PDO::PARAM_INT);
            $statement->execute();

            $rdvInfos = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $rdvInfos;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getProjetsDispos() {
        try {
            $database = Model::getInstance();

            $query = "
            SELECT 
                PJ.id AS projet_id,
                PJ.label AS projet_label,
                PJ.groupe AS groupe_max,
                COUNT(R.id) AS nb_rdv_pris
            FROM projet PJ
            LEFT JOIN creneau CR ON CR.projet = PJ.id
            LEFT JOIN rdv R ON R.creneau = CR.id
            GROUP BY PJ.id, PJ.label, PJ.groupe
            HAVING nb_rdv_pris < groupe_max
        ";

            $statement = $database->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    public static function getCreneauxDisponibles() {
        try {
            $database = Model::getInstance();

            $query = "
            SELECT 
                CR.id AS creneau_id,
                CR.creneau,
                CR.projet,
                PJ.label AS projet_label,
                PJ.groupe AS groupe_max,
                COUNT(R.id) AS nb_rdv_pris
            FROM creneau CR
            JOIN projet PJ ON CR.projet = PJ.id
            LEFT JOIN rdv R ON R.creneau = CR.id
            GROUP BY CR.id, CR.creneau, CR.projet, PJ.label, PJ.groupe
            HAVING nb_rdv_pris < groupe_max
        ";

            $statement = $database->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    public static function insertRdv($creneau_id, $etudiant_id) {
        try {
            $database = Model::getInstance();

            // Générer un nouvel ID pour rdv
            $query = "SELECT MAX(id) + 1 FROM rdv";
            $statement = $database->query($query);
            $newRdvId = $statement->fetchColumn();
            if (!$newRdvId) {
                $newRdvId = 1;
            }

            // Insérer le rdv
            $query = "INSERT INTO rdv (id, creneau, etudiant) VALUES (:id, :creneau, :etudiant)";
            $statement = $database->prepare($query);
            $statement->bindParam(':id', $newRdvId, PDO::PARAM_INT);
            $statement->bindParam(':creneau', $creneau_id, PDO::PARAM_INT);
            $statement->bindParam(':etudiant', $etudiant_id, PDO::PARAM_INT);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
}
