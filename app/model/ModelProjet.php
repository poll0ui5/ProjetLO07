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
}
