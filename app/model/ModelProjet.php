<?php

require_once 'Model.php';
require_once 'ModelPersonne.php';

class ModelProjet {

    private $id, $label, $responsable, $groupe;

    /* public function __construct($id = null, $label = null, $responsable = null, $groupe = null) {
      $this->id = $id;
      $this->label = $label;
      $this->responsable = $responsable;
      $this->groupe = $groupe;
      } */

    public function __construct() {
        // vide, pour PDO::FETCH_CLASS
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

    public static function getProjetResponsable($respo_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT label, responsable, groupe FROM projet WHERE responsable = $respo_id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProjet");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($label, $responsable, $groupe) {
        try {
            $database = Model::getInstance();

            // Étape 1 : calcul de l'identifiant
            $query = "SELECT MAX(id) FROM projet";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple[0] + 1;

            // Étape 2 : insertion
            $query = "INSERT INTO projet (id, label, responsable, groupe)
                  VALUES (:id, :label, :responsable, :groupe)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'label' => $label,
                'responsable' => $responsable,
                'groupe' => $groupe
            ]);

            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getProjetsByExaminateur($examinateur_id) {
        try {
            $database = Model::getInstance();

            $query = "
                SELECT DISTINCT
                    PJ.id      AS projet_id,
                    PJ.label   AS projet_label,
                    PJ.responsable,
                    PJ.groupe
                FROM projet PJ
                JOIN creneau CR ON CR.projet = PJ.id
                WHERE CR.examinateur = :exam_id
                ORDER BY PJ.label
            ";

            $statement = $database->prepare($query);
            $statement->bindParam(':exam_id', $examinateur_id, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    //l'inverse ;)
    public static function getExaminateursByProjet($projet_id) {
        try {
            $database = Model::getInstance();
            $query = "
                SELECT DISTINCT
                    EX.id       AS examinateur_id,
                    EX.nom      AS nom,
                    EX.prenom   AS prenom
                FROM creneau CR
                JOIN personne EX   ON CR.examinateur = EX.id
                WHERE CR.projet = :projet_id
                ORDER BY EX.nom, EX.prenom
            ";
            $statement = $database->prepare($query);
            $statement->bindParam(':projet_id', $projet_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    public static function getProjetsByResponsable($resp_id) {
        try {
            $database = Model::getInstance();

            $query = "
                SELECT
                    id   AS projet_id,
                    label AS projet_label,
                    groupe
                FROM projet
                WHERE responsable = :resp_id
                ORDER BY label
            ";

            $statement = $database->prepare($query);
            $statement->bindParam(':resp_id', $resp_id, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    public static function getPlanningByProjet($projet_id) {
        try {
            $database = Model::getInstance();
            $query = "
                SELECT
                  rdv_id,
                  projet_label,
                  etudiant_id,
                  etudiant_nom,
                  etudiant_prenom,
                  examinateur_id,
                  examinateur_nom,
                  examinateur_prenom,
                  creneau AS date_heure
                FROM infordv
                WHERE projet_id = :projet_id
                ORDER BY date_heure
            ";
            $statement = $database->prepare($query);
            $statement->bindParam(':projet_id', $projet_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }
}
