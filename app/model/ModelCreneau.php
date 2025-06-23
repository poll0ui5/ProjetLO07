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

    public static function getCreneauxByExaminateur($examinateur_id) {
        try {
            $database = Model::getInstance();

            $query = "
            SELECT 
                creneau_id,
                projet_id,
                label AS projet_label,
                examinateur_id,
                nom AS examinateur_nom,
                prenom AS examinateur_prenom,
                creneau,
                groupe AS groupe_max
            FROM infocreneaux
            WHERE examinateur_id = :exam_id
            ORDER BY creneau
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

    public static function getProjetsByExaminateur($examinateur_id) {
        try {
            $database = Model::getInstance();
            $query = "
                SELECT DISTINCT 
                    PJ.id   AS projet_id,
                    PJ.label AS projet_label
                FROM creneau CR
                JOIN projet PJ ON CR.projet = PJ.id
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

    public static function getCreneauxByProjetAndExaminateur($projet_id, $examinateur_id) {
        try {
            $database = Model::getInstance();
            $query = "
                SELECT 
                    id          AS creneau_id,
                    creneau     AS datetime
                FROM creneau
                WHERE projet = :projet_id
                  AND examinateur = :exam_id
                ORDER BY creneau
            ";
            $statement = $database->prepare($query);
            $statement->bindParam(':projet_id', $projet_id, PDO::PARAM_INT);
            $statement->bindParam(':exam_id', $examinateur_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    public static function getAllProjets() {
        try {
            $database = Model::getInstance();
            $query = "SELECT id AS projet_id, label AS projet_label FROM projet ORDER BY label";
            $statement = $database->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return [];
        }
    }

    public static function insertCreneau($projet_id, $examinateur_id, $creneau_datetime) {
        try {
            $database = Model::getInstance();

            $query = "SELECT MAX(id) + 1 FROM creneau";
            $statement = $database->query($query);
            $newId = $statement->fetchColumn() ?: 1;

            $query = "INSERT INTO creneau (id, projet, examinateur, creneau)
                      VALUES (:id, :projet, :examinateur, :creneau)";
            $statement = $database->prepare($query);
            $statement->bindParam(':id', $newId, PDO::PARAM_INT);
            $statement->bindParam(':projet', $projet_id, PDO::PARAM_INT);
            $statement->bindParam(':examinateur', $examinateur_id, PDO::PARAM_INT);
            $statement->bindParam(':creneau', $creneau_datetime);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    public static function insertMultipleCreneaux($projet_id, $examinateur_id, $start_datetime, $count) {
        try {
            $database = Model::getInstance();
            $database->beginTransaction();

            // Calcul et insertion des N créneaux
            $dt = new DateTime($start_datetime);
            for ($i = 0; $i < $count; $i++) {
                // Générer nouvel ID
                $newId = (int) $database->query("SELECT COALESCE(MAX(id),0) + 1 FROM creneau")->fetchColumn();

                // Préparer et exécuter l'INSERT
                $stmt = $database->prepare(
                        "INSERT INTO creneau (id, projet, examinateur, creneau)
                     VALUES (:id, :projet, :examinateur, :creneau)"
                );
                $stmt->bindParam(':id', $newId, PDO::PARAM_INT);
                $stmt->bindParam(':projet', $projet_id, PDO::PARAM_INT);
                $stmt->bindParam(':examinateur', $examinateur_id, PDO::PARAM_INT);
                $current = $dt->format('Y-m-d H:i:s');
                $stmt->bindParam(':creneau', $current);
                $stmt->execute();

                // Passer à l'heure suivante
                $dt->modify('+1 hour');
            }

            $database->commit();
            return true;
        } catch (PDOException $e) {
            $database->rollBack();
            printf("%s – %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }
}
